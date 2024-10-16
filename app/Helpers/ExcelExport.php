<?php

namespace App\Helpers;

use ZipArchive;

class ExcelExport
{
    public static function generate($data, $filename = 'export.xlsx')
    {
        $zip = new ZipArchive();
        $tmp_file = tempnam(sys_get_temp_dir(), 'xlsx');
        $zip->open($tmp_file, ZipArchive::CREATE);

        // Tambahkan kode XML yang diperlukan (seperti yang ada di jawaban sebelumnya)
        // ...

        // Buat sheet1.xml dengan data
        $sheet1 = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><sheetData>';
        
        foreach ($data as $row) {
            $sheet1 .= '<row>';
            foreach ($row as $cell) {
                $sheet1 .= '<c><v>' . htmlspecialchars($cell) . '</v></c>';
            }
            $sheet1 .= '</row>';
        }
        
        $sheet1 .= '</sheetData></worksheet>';
        $zip->addFromString('xl/worksheets/sheet1.xml', $sheet1);

        $zip->close();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        readfile($tmp_file);
        unlink($tmp_file);

        exit;
    }
}