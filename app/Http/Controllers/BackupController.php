<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;



class BackupController extends Controller
{
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'administrador') {
            return response()->json(['error' => 'No autorizado'], 403);
        }
        try {
            // Nombre del archivo
            $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
            $directory = public_path('backups');
            $filePath = $directory . '/' . $filename;

            // Crear directorio si no existe
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
            Log::info("Directorio listo ... ");
            // Crear backup (tu código existente)
            $tables = DB::select('SHOW TABLES');
            $handle = fopen($filePath, 'w+');
            Log::info("Preparando archivo ... ");
            foreach ($tables as $table) {
                $tableName = reset($table);
                $createTable = DB::selectOne("SHOW CREATE TABLE $tableName");
                fwrite($handle, $createTable->{'Create Table'} . ";\n\n");

                $rows = DB::table($tableName)->get();
                foreach ($rows as $row) {
                    $values = array_map(function ($value) {
                        return "'" . addslashes($value) . "'";
                    }, (array) $row);
                    fwrite($handle, "INSERT INTO $tableName VALUES (" . implode(', ', $values) . ");\n");
                }
                fwrite($handle, "\n");
            }
            fclose($handle);
            //return $filePath . ' / ' . $filename;
            Log::info("Descargando ... " . public_path('backups/' . $filename));
            Session::flash('success', 'Backup generado en public/backup');

            return response()->download(public_path('backups/' . $filename))->deleteFileAfterSend(true);
            //Log::info("Descargando ... " . public_path('capacitacion1.jpg'));

            //return response()->download(public_path('capacitacion1.jpg'))->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al generar el backup',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function download($filename): StreamedResponse
    {
        // Validación de seguridad

        $filePath = storage_path("app/backups/{$filename}");
        $this->validateBackupFile($filePath);

        // Configurar headers para forzar la descarga


        // Usar stream para mejor manejo de memoria
        return response()->stream(function () use ($filePath) {
            $stream = fopen($filePath, 'rb');
            fpassthru($stream);
            fclose($stream);
        }, 200);
    }


    protected function validateBackupFile(string $filePath): void
    {
        if (!file_exists($filePath)) {
            throw new \Exception("El archivo de backup no existe");
        }

        if (filesize($filePath) === 0) {
            unlink($filePath);
            throw new \Exception("El archivo de backup está vacío");
        }

        $content = file_get_contents($filePath, false, null, 0, 100);
        if (!str_contains($content, 'MySQL Backup')) {
            unlink($filePath);
            throw new \Exception("El archivo generado no es un backup válido");
        }
    }



    protected function getBackupHeader(): string
    {
        return "-- MySQL Backup\n" .
            "-- Generated: " . now()->toDateTimeString() . "\n" .
            "-- Host: " . config('database.connections.mysql.host') . "\n" .
            "-- Database: " . config('database.connections.mysql.database') . "\n" .
            "-- PHP Version: " . phpversion() . "\n" .
            "-- Laravel Version: " . app()->version() . "\n\n" .
            "SET FOREIGN_KEY_CHECKS=0;\n" .
            "SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';\n" .
            "SET AUTOCOMMIT=0;\n" .
            "START TRANSACTION;\n\n";
    }

    protected function getBackupFooter(): string
    {
        return "\nCOMMIT;\n" .
            "SET FOREIGN_KEY_CHECKS=1;\n" .
            "SET AUTOCOMMIT=1;\n" .
            "-- Backup completed\n";
    }
}
