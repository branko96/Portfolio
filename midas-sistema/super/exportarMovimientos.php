<?php
  //var_dump($_POST);
  session_start();
  $idClub=$_SESSION['club']['id'];

  require_once("content/database.php");
  include("content/Classes/PHPExcel.php");

  $db=new database();
  $db->conectar();

  $sql = "SELECT a.*,b.tipo as tipoMov, c.*,(select d.nombreClub from em_club d where d.idclub=a.club limit 1) as nombreClub,(select e.titulo from em_premios e where e.idpremios=a.premio limit 1) as titulo from em_movimientos a left join em_tipomovimiento b on a.tipoMovimiento=b.idtipoMovimiento left join em_socios c on a.socio=c.idSocios left join em_club d on a.club=d.idClub   WHERE a.club='$idClub'";
  if($_POST['desde']!='')
  {
    $desde=date('Y/m/d ',strtotime($_POST['desde']));
     $desde;
    $sql= $sql." and DATE_FORMAT(a.fecha,'%Y%m%d')>= DATE_FORMAT('$desde','%Y%m%d')";
  }
   if($_POST['hasta']!='')
  {
    $hasta=date('Y/m/d ',strtotime($_POST['hasta']));
    //echo $hasta;
    $sql= $sql." and DATE_FORMAT(a.fecha,'%Y%m%d')<= DATE_FORMAT('$hasta','%Y%m%d')";
  }
  //echo $sql;
  $consulta=$db->query($sql);
  $objPHPExcel = new PHPExcel();
  $tituloReporte = "Reporte consultas";
  // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
//$objPHPExcel->setActiveSheetIndex(0)
    //->mergeCells('A1:E1');
 
// Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
    //->setCellValue('B1',$tituloReporte) // Titulo del reporte
    ->setCellValue('A1','FECHA MOV')  //Titulo de las columnas
    ->setCellValue('B1','HORA MOV')
    ->setCellValue('C1','TIPO MOV')  
    ->setCellValue('D1','IMPORTE') 
    ->setCellValue('E1','PUNTOS SUMA') 
    ->setCellValue('F1', 'PUNTOS DIARIOS') 
    ->setCellValue('G1','SOCIO')
    ->setCellValue('H1', 'DNI')
    ->setCellValue('I1', 'Nº TARJETA')
    ->setCellValue('J1', 'CLUB') 
    ->setCellValue('K1', 'PREMIO') 
    ->setCellValue('L1', 'ACUMULADOS');
    $i=2;
    while ($fila=mysqli_fetch_assoc($consulta)) {
       $objPHPExcel->setActiveSheetIndex(0)
         ->setCellValue('A'.$i, date('d/m/Y',strtotime($fila['fecha'])))
         ->setCellValue('B'.$i, $fila['hora'])
         ->setCellValue('C'.$i, $fila['tipoMov'])
         ->setCellValue('D'.$i, $fila['importe'])
         ->setCellValue('E'.$i, $fila['puntosSuma'])
         ->setCellValue('F'.$i, $fila['puntosTotalDiario'])
         ->setCellValue('G'.$i, $fila['nombre'])
         ->setCellValue('H'.$i, $fila['nDocumento'])
         ->setCellValue('I'.$i, $fila['nTarjeta'])
         ->setCellValue('J'.$i, $fila['nombreClub'])
         ->setCellValue('K'.$i, $fila['titulo'])
         ->setCellValue('L'.$i, $fila['puntosAcumulados']);
       $i++;  
    }
    //aplica stylo a cabacera
    $objPHPExcel-> getActiveSheet()
                -> getStyle('A1:L1')
                -> getFill()
                -> setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                -> getStartColor()->setARGB('DDC6E7');
    for($i = 'A'; $i <= 'K'; $i++){
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