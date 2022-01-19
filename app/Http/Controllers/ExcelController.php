<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use http\Env\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToArray;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpParser\Node\Stmt\Return_;
use App\Models\ParseModel;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Calculation\Engine\CyclicReferenceStack;
use PhpOffice\PhpSpreadsheet\Calculation\Engine\Logger;
use PhpOffice\PhpSpreadsheet\Calculation\Token\Stack;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\DefinedName;
use PhpOffice\PhpSpreadsheet\ReferenceHelper;
use PhpOffice\PhpSpreadsheet\Shared;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use ReflectionClassConstant;
use ReflectionMethod;
use ReflectionParameter;
use function MongoDB\BSON\toJSON;

class ExcelController extends Controller
{
    public function readxlsx()
    {
        header('Content-Type: application/json');
        $reader = IOFactory::createReader("Xlsx");
        $speedsheet = $reader->load("C:\Users\admin\Desktop\Справка.xlsx");
        $reader->setReadDataOnly(false);
        $sheet = $speedsheet->getActiveSheet()->getCell('H12')->getOldCalculatedValue();

        //$sheet =$speedsheet->getActiveSheet()->getCell('B12')->getValue();
        // dd($sheet);
        $root=[
            'struct' => [],
            'projects'=>[],
            'total'=>[],
        ];

        $struct_position = [];
        $struct_struct = [];
        $departament_position = [];
        $departament_person = [];
        $hope = [];
        $person = [];
        $project_data_area = [];
        $v = 't';
//array_push($struct_border,'struct');
        $col_struct = 0;
        $col_project = 0;

        for ($y = 'G'; $y != 'B'; $y++){
            $sheet = $speedsheet->getActiveSheet()->getCell($y . '14')->getValue();
            if($y > 'G'){
                if(isset($sheet)){
                    $project_data_area[$y] = 1;
                }else{
                    $y='A';
                }
            }
        }
        for ($x = 0; $x <= 41; $x++) {

            for ($y = 'B'; $y <= 'X'; $y++) {
                if ($x < 12 or ($x >= 12 and ($y === 'B' or $y === 'C' or $y === 'D'))) {
                    $sheet = $speedsheet->getActiveSheet()->getCell($y . ((string)$x))->getValue();

                } else {

                    $sheet = $speedsheet->getActiveSheet()->getCell($y . ((string)$x))->getOldCalculatedValue();

                }
                //формирование данных - завершено
                //Если строка 2, то при наличии значения записывать номер столбца в массив границ структур
                if ($x === 2) {
                    if (isset($sheet)) {
                        $col_struct++;
                        $v = $y;
                        $struct_position[$y] = $sheet;
                    }
                    if($col_struct and $y<'R'){
                        $struct_struct[$v][]=$y;
                    }


                }
                elseif($x === 3) {

                    if (isset($sheet)) {
                        $person[$y] = $sheet;

                    }

                }
                elseif ($x === 5) {
                    if (isset($sheet)) {
                        $departament_position[$y] = $sheet;
                    }

                }
                elseif ($x === 6) {
                    if (isset($sheet)) {
                        $departament_person[$y] = $sheet;
                    }

                }
                elseif ($x > 11 and $x<38){
                    if($y === 'B'){
                        $root['projects'][$col_project]['project_name'] = $sheet;

                    }
                    elseif ($y === 'C'){
                        $root['projects'][$col_project]['project_type'] = $sheet;
                    }
                    elseif ($y === 'D'){
                        $root['projects'][$col_project]['project_manager'] = $sheet;
                    }
                    elseif (isset($project_data_area[$y])){
                        $root['projects'][$col_project]['project_data'][] = $sheet;
                    }
                    elseif ($y === 'T'){
                        $root['projects'][$col_project]['project_sum'][] = $sheet;
                    }
                    elseif ($y === 'U'){
                        $root['projects'][$col_project]['project_sum'][] = $sheet;
                    }
                    elseif ($y === 'W'){
                        $root['projects'][$col_project]['project_fact'][] = $sheet;
                    }
                    elseif ($y === 'X'){
                        $root['projects'][$col_project]['project_fact'][] = $sheet;
                    }

                }
                elseif ($x === 40){
                    if (isset($project_data_area[$y])){
                        $root['total']['total_sum'][] = $sheet;
                    }
                }
                elseif ($x === 41){
                    if (isset($project_data_area[$y])){
                        $root['total']['total_fact'][] = $sheet;
                    }
                }
            }
            if($x>11){$col_project++;}
        }


        #print_r($root);
        //  print_r($departament);
        // разбор заголовка до 12 строки с H по Q struct
        $col_struct = 0;

        foreach ($struct_struct as $number => $array){
            $counter = 0;

            $root['struct'][$col_struct]['position'] = $struct_position[$number];
            if(isset($person[$number])) {
                $root['struct'][$col_struct]['person'] = $person[$number];
            }else{ $root['struct'][$col_struct]['person'] = null;
            }

            foreach ($array as $number2 => $coordinate){
                if(isset($departament_position[$coordinate])) {
                    $root['struct'][$col_struct]['departament'][$counter]['position'] = $departament_position[$coordinate];
                    if(isset($departament_person[$coordinate])){
                        $root['struct'][$col_struct]['departament'][$counter]['person'] = $departament_person[$coordinate];
                    } else {$root['struct'][$col_struct]['departament'][$counter]['person'] = null;
                    }
                    $counter++;

                }
            }
            $col_struct++;
        }



         $root = json_encode($root, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_FORCE_OBJECT);
         print_r($root);
        # if (isset($array))

        /*
            foreach ($position as $coordinate => $value) {
                if (isset($struct_position[$coordinate])) {

                    print_r($struct_position[$coordinate]);
                }
                print_r($value);
            }
        */







        /*
                     $Cell=(explode(''.$y.'',  ''.$sheet.''));
                    $CellJson = json_encode($Cell,JSON_FORCE_OBJECT|JSON_UNESCAPED_UNICODE|JSON_HEX_QUOT|JSON_HEX_APOS|JSON_HEX_AMP);
                     print_r($CellJson);

                    //$Cell = str_split($sheet);
                    print_r($Cell);
            */
    //  print_r(('<p>'.$y.((string)$x). ' '.$sheet.' </p>' ));




    //print_r('<p>'.$y.((string)$x). ' '.$sheet.' </p>' );


    }


    public function import(Request $request)
    {

        $file = Excel::import(new UsersImport(),$request->file('files'),null,\Maatwebsite\Excel\Excel::XLSX);


        return ;
    }

}
