<?php
	require 'PHPExcel/PHPExcel.php';

	try {
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle("Reporte Historial de Pláticas")->setCreator("Peña Colorada")->setDescription("Reporte descargado de sistema Plática de 5 Minutos");

		$infoStyle = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'C6361B'),		// Rojo Peña Colorada
				'size'  => 12,
				'name'  => 'Calibri'
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'F2F2F2')
			),
			'alignment' =>  array(
				'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
			)
		);

		$theadStyle = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => '5D7388'),		// Azul Peña Colorada
				'size'  => 12,
				'name'  => 'Calibri'
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'F2F2F2')
			),
			'alignment' =>  array(
				'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '1F497D')
				)
			)
		);

		$tbodyStyle = array(
			'alignment' =>  array(
				'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
		);

		// NOTE: max_input_vars changed from 1000 variables to 300,000 and post_max_size from 2MB to 50MB in php.ini
		// because POST sliced the array at 1000 elements (100 rows, 10 keys each)

		$fi_date = date_create($_POST['fi']);
		$fi = date_format($fi_date, 'd/m/Y');
		$ft_date = date_create($_POST['ft']);
		$ft = date_format($ft_date, 'd/m/Y');
		$supervisor_select = $_POST['supervisor_select'];
		$anio = $_POST['anio'];
		$semana = $_POST['semana'];
		$fecha = $_POST['fecha'];
		$platica = $_POST['platica'];
		$clave_supervisor = $_POST['clave_supervisor'];
		$supervisor = $_POST['supervisor'];
		$empresa = $_POST['empresa'];
		$codigo = $_POST['codigo'];
		$empleado = $_POST['empleado'];
		$puesto = $_POST['puesto'];

		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle("reporte_platicas");
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(50);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "Fecha de inicio:");
		$objPHPExcel->getActiveSheet()->setCellValue('A2', "Fecha de término:");
		$objPHPExcel->getActiveSheet()->setCellValue('A3', "Supervisor:");
		$objPHPExcel->getActiveSheet()->setCellValue('B1', $fi);
		$objPHPExcel->getActiveSheet()->setCellValue('B2', $ft);
		$objPHPExcel->getActiveSheet()->setCellValue('B3', $supervisor_select);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', "Año");
		$objPHPExcel->getActiveSheet()->setCellValue('B4', "Semana");
		$objPHPExcel->getActiveSheet()->setCellValue('C4', "Fecha");
		$objPHPExcel->getActiveSheet()->setCellValue('D4', "Plática");
		$objPHPExcel->getActiveSheet()->setCellValue('E4', "Clave supervisor");
		$objPHPExcel->getActiveSheet()->setCellValue('F4', "Supervisor");
		$objPHPExcel->getActiveSheet()->setCellValue('G4', "Empresa");
		$objPHPExcel->getActiveSheet()->setCellValue('H4', "Código");
		$objPHPExcel->getActiveSheet()->setCellValue('I4', "Empleado");
		$objPHPExcel->getActiveSheet()->setCellValue('J4', "Puesto");

		$excelRow = 5;
		for($i = 0; $i < count($empleado); $i++) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $excelRow, $anio[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $excelRow, $semana[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $excelRow, $fecha[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $excelRow, $platica[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $excelRow, $clave_supervisor[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $excelRow, $supervisor[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $excelRow, $empresa[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $excelRow, $codigo[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue('I' . $excelRow, $empleado[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue('J' . $excelRow, $puesto[$i]);
			$excelRow++;
		}
		$excelRow--;

		$objPHPExcel->getActiveSheet()->getStyle('A1:B3')->applyFromArray($infoStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A4:J4')->applyFromArray($theadStyle);
		$objPHPExcel->getActiveSheet()->getStyle('A5:J' . $excelRow)->applyFromArray($tbodyStyle);

		ob_end_clean();
		//header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename='Reporte Historial de Pláticas.xlsx'");
		header("Cache-Control: max-age=0");

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	} // try
	catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	} // catch
?>