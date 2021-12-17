<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeestController extends Controller
{
    public function index()
    {
        /* header('Content-type:Application/json');
          $g= [
      'sturct'=>[
          [
      'person'=>'Есаулов Алексей Олегович',
       'position'=>'Технический директор',
          'departament' => [ [

              'position' => 'Руководитель департамента разработки',
              'person'=>'Чернокнижников Илья Александрович',

          ],
              [
                  'position'=>'Руководитель департамента аналитических решений',
                  'person' => 'Сотский Григорий Олегович',

              ]



          ],





          ],
             ],
              ];
          $g = json_encode($g, JSON_FORCE_OBJECT|JSON_UNESCAPED_UNICODE);

        print_r($g);
     */

        header('Content-type:Application/json');
        $struct = [
            $person1 = [
                'person' => 'Есаулов Алексей Олегович',
                'person' => 'Прокопенко Алексей',
            ],
            $position1 = [
                'position' => 'Начальник тех.',
                'position' => 'Начальник сопровод',
            ],
            $departament = [
                $position2 = [
                    'position' => 'Руководитель разработки',

                ],
                $pesron2 = [

                    'person' => 'Илья Александрович',
                ],

            ],
        ];
        foreach ($struct as $key =>$value){

            foreach ($value as  $person1) {
              print_r($person1);

            }

        }
        foreach ($value as $position1) {
            print_r($position1);

        }
        $struct = json_encode($struct, JSON_FORCE_OBJECT|JSON_UNESCAPED_UNICODE);

      //  print_r($struct);


    }
}
