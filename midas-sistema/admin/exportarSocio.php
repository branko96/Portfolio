<?php
  session_start();
  $idClub=$_SESSION['club']['id'];

  require_once("content/database.php");
  include("content/Classes/PHPExcel.php");

  $db=new database();
  $db->conectar();

  $sql = "SELECT * FROM em_socios s INNER JOIN em_club c ON c.idClub = s.club WHERE s.club='$idClub'";
  $consulta=$db->query($sql);
  $objPHPExcel = new PHPExcel();
  $tituloReporte = "Reporte consultas";
  // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
//$objPHPExcel->setActiveSheetIndex(0)
    //->mergeCells('A1:E1');
 
// Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
    //->setCellValue('B1',$tituloReporte) // Titulo del reporte
    ->setCellValue('A1','Nombre')  //Titulo de las columnas
    ->setCellValue('B1','Sexo')
    ->setCellValue('C1', 'Email')
    ->setCellValue('D1', 'DNI')
    ->setCellValue('E1', 'Fecha Nac.')
     ->setCellValue('F1', 'Nº Celular')
    ->setCellValue('G1', 'Puntos Acumulados')
    ->setCellValue('H1', 'NTarjeta')
    ->setCellValue('I1', 'Club'); 
    $i=2;
    while ($fila=mysqli_fetch_assoc($consulta)) {
       $objPHPExcel->setActiveSheetIndex(0)
         ->setCellValue('A'.$i, $fila['nombre'])
         ->setCellValue('B'.$i, $fila['sexo'])
         ->setCellValue('C'.$i, $fila['email'])
         ->setCellValue('D'.$i, $fila['nDocumento'])
          ->setCellValue('E'.$i, $fila['fNacimiento'])
          ->setCellValue('F'.$i, $fila['celular'])
         ->setCellValue('G'.$i, $fila['puntosAcumulados'])
         ->setCellValue('H'.$i, $fila['nTarjeta'])
         ->setCellValue('I'.$i, $fila['nombreClub']);
       $i++;  
    }
    //aplica stylo a cabacera
    $objPHPExcel-> getActiveSheet()
                -> getStyle('A1:G1')
                -> getFill()
                -> setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                -> getStartColor()->setARGB('DDC6E7');
    for($i = 'A'; $i <= 'G'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
    }
    // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="Reporte.xlsx"');
// header('Cache-Control: max-age=0');
// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte-Midas.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>