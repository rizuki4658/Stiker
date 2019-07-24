
<?php
require_once 'Core/init.php';
if ($user->Logging()) {
    if (Session::get('user_status')!='Admin') {
       Redirect::to('index');
    }
}else{
    Redirect::to('login');
}

$date1=date('Y-m-d');
$date2=date('Y-m-d');;

if (Input::get('category')=='Month') {
	
	if(Input::get('Month')){
		if(Input::get('Month')==1){
			$date1=date(Input::get('Years').'-01-01');
			$date2=date(Input::get('Years').'-01-31');
		}elseif(Input::get('Month')==2){
			$date1=date(Input::get('Years').'-02-01');
			$date2=date(Input::get('Years').'-02-28');
		}elseif(Input::get('Month')==3){
			$date1=date(Input::get('Years').'-03-01');
			$date2=date(Input::get('Years').'-03-31');
		}elseif(Input::get('Month')==4){
			$date1=date(Input::get('Years').'-04-01');
			$date2=date(Input::get('Years').'-04-30');
		}elseif(Input::get('Month')==5){
			$date1=date(Input::get('Years').'-05-01');
			$date2=date(Input::get('Years').'-05-31');
		}elseif(Input::get('Month')==6){
			$date1=date(Input::get('Years').'-06-01');
			$date2=date(Input::get('Years').'-06-30');
		}elseif(Input::get('Month')==7){
			$date1=date(Input::get('Years').'-07-01');
			$date2=date(Input::get('Years').'-07-31');
		}elseif(Input::get('Month')==8){
			$date1=date(Input::get('Years').'-08-01');
			$date2=date(Input::get('Years').'-08-31');
		}elseif(Input::get('Month')==9){
			$date1=date(Input::get('Years').'-09-01');
			$date2=date(Input::get('Years').'-09-30');
		}elseif(Input::get('Month')==10){
			$date1=date(Input::get('Years').'-10-01');
			$date2=date(Input::get('Years').'-10-31');
		}elseif(Input::get('Month')==11){
			$date1=date(Input::get('Years').'-11-01');
			$date2=date(Input::get('Years').'-11-30');
		}elseif(Input::get('Month')==12){
			$date1=date(Input::get('Years').'-12-01');
			$date2=date(Input::get('Years').'-12-31');
		}
	}
	$value_category=Input::get('Month');
	$value_years=Input::get('Years');
}elseif(Input::get('category')=='Quarter'){
	
	if(Input::get('Quarter')==1){
		$date1=date(Input::get('Years').'-01-01');
		$date2=date(Input::get('Years').'-03-31');
	}elseif (Input::get('Quarter')==2) {
		$date1=date(Input::get('Years').'-04-01');
		$date2=date(Input::get('Years').'-06-30');
	}elseif (Input::get('Quarter')==3) {
		$date1=date(Input::get('Years').'-07-01');
		$date2=date(Input::get('Years').'-09-30');
	}elseif (Input::get('Quarter')==4) {
		$date1=date(Input::get('Years').'-10-01');
		$date2=date(Input::get('Years').'-12-31');
	}

	$value_category=Input::get('Quarter');
	$value_years=Input::get('Years');

}elseif(Input::get('category')=='Semester'){
	
	if(Input::get('Semester')==1){
		$date1=date(Input::get('Years').'-01-01');
		$date2=date(Input::get('Years').'-06-30');
	}elseif (Input::get('Semester')==2) {
		$date1=date(Input::get('Years').'-07-01');
		$date2=date(Input::get('Years').'-12-31');
	}


	$value_category=Input::get('Semester');
	$value_years=Input::get('Years');

}elseif(Input::get('category')=='Years'){
	$date1=date(Input::get('Years').'-01-01');
	$date2=date(Input::get('Years').'-12-31');

	$value_category=Input::get('Years');
	$value_years=Input::get('Years');
}
$category=Input::get('category');
$data	=$report->get_report($date1, $date2);
$baris	=mysqli_num_rows($data);
$data_company=$dashboard_comp->get_rows_comp_id(1);

while ($dataprofile=mysqli_fetch_assoc($data_company)) {	
	$name 		=$dataprofile['name'];
	$address	=$dataprofile['address'];
	$zip 		=$dataprofile['zip_code'];
	$phone 		=$dataprofile['phone'];
}
if ($baris<=0) {
	Session::set('error_report', 'Data is not found!');
	if (Input::get('category')=='Month') {
		Redirect::to('Dashboard Month');
	}elseif(Input::get('category')=='Quarter'){
		Redirect::to('Dashboard Quarter');
	}elseif(Input::get('category')=='Semester'){
		Redirect::to('Dashboard Semester');
	}elseif(Input::get('category')=='Years'){
		Redirect::to('Dashboard Years');
	}
}else{ 
	require('Vendor/phpfpdf/fpdf.php');

	class PDF extends FPDF
	{
	    //Page header
	    function Header()
	    {
	        //Logo
	    	global $name, $address, $zip, $phone, $category, $value_category, $value_years;
	        $this->Image('Assets/img/Logo stiker.png',10,5,20,20);
	        $this->SetFont('Arial','B',20);
	        $this->SetX(130);
	        $this->Cell(35,0, strtoupper($name),0,0,'C');
	    
	    if ($category=='Month') {
	    	$name_month='';
	    	if($value_category==1){
	    		$name_month="JANUARI";
	    	}elseif($value_category==2){
	    		$name_month="FEBRUARI";
	    	}elseif($value_category==3){
	    		$name_month="MARET";
	    	}elseif($value_category==4){
	    		$name_month="APRIL";
	    	}elseif($value_category==5){
	    		$name_month="MEI";
	    	}elseif($value_category==6){
	    		$name_month="JUNI";
	    	}elseif($value_category==7){
	    		$name_month="JULI";
	    	}elseif($value_category==8){
	    		$name_month="AGUSTUS";
	    	}elseif($value_category==9){
	    		$name_month="SEPTEMBER";
	    	}elseif($value_category==10){
	    		$name_month="OKTOBER";
	    	}elseif($value_category==11){
	    		$name_month="NOVEMBER";
	    	}elseif($value_category==12){
	    		$name_month="DESEMBER";
	    	}
	        $this->Ln(7);
	        $this->SetFont('Arial','B',10);
	        $this->SetX(130);
	        $this->Cell(35,0, "LAPORAN PENJUALAN BULAN ".$name_month." ".$value_years,0,0,'C');
	    }elseif($category=='Quarter'){
	    	$name_month='';
	    	if($value_category==1){
	    		$name_month="JANUARI sd MARET";
	    	}elseif($value_category==2){
	    		$name_month="APRIL sd JUNI";
	    	}elseif($value_category==3){
	    		$name_month="JULI sd SEPTEMBER";
	    	}elseif($value_category==4){
	    		$name_month="OKTOBER sd DESEMBER";
	    	}
	    	$this->Ln(7);
	        $this->SetFont('Arial','B',15);
	        $this->SetX(130);
	       	$this->Cell(35,0, "LAPORAN PENJUALAN BULAN ".$name_month." ".$value_years,0,0,'C');
	    }elseif($category=='Semester'){
	    	$name_month='';
	    	if($value_category==1){
	    		$name_month="JANUARI sd JUNI";
	    	}elseif($value_category==2){
	    		$name_month="JULI sd DESEMBER";
	    	}
	    	$this->Ln(7);
	        $this->SetFont('Arial','B',10);
	        $this->SetX(130);
	       	$this->Cell(35,0, "LAPORAN PENJUALAN BULAN ".$name_month." ".$value_years,0,0,'C');
	    }elseif($category=='Years'){
	    	$this->Ln(7);
	        $this->SetFont('Arial','B',10);
	        $this->SetX(130);
	       	$this->Cell(35,0, "LAPORAN PENJUALAN TAHUN ".$value_years,0,0,'C');
	    }    
	        

	        $this->Ln(5);
	        $this->SetFont('Arial','B',10);
	        $this->SetX(130);
	        $this->Cell(35,0, $address." ".$zip,0,0,'C');
	        
	        $this->Ln(5);
	        $this->SetX(130);
	        $this->Cell(35,0,"Telp.".$phone,0,0,'C');
	        
	        $this->Line(5,30,292,30);
	        
	        $this->SetFont('Arial','B',12);
	        
	        $this->Ln(10);
	        $this->SetX(20);
	    if ($category=='Month') {
	    	$this->Cell(0,8,"Laporan Per Bulan",0,0,'L');
	    }elseif($category=='Quarter'){
	    	$this->Cell(0,8,"Laporan Quartal ".$value_category,0,0,'L');
	    }elseif($category=='Semester'){
	    	$this->Cell(0,8,"Laporan Semester ".$value_category,0,0,'L');
	    }elseif($category=='Years'){
	    	$this->Cell(0,8,"Laporan Per Tahun",0,0,'L');
	    }
	        $this->Ln(5);
	        $this->SetFont('Arial','B',10);
	       

	    }
	 
	    //Page Content
	    function Content()
	    {
	    	$this->Ln(2);
	    	$this->SetFont('Times','B',10);
	        $this->SetX(20);
	        $this->Cell(8,5,"No",1,0,'C');
	        $this->Cell(20,5,"Kategori",1,0,'C');
	        $this->Cell(60,5,"Nama Customer",1,0,'C');
	        $this->Cell(60,5,"Email",1,0,'C');
	        $this->Cell(30,5,"Phone",1,0,'C');
	        $this->Cell(20,5,"Status",1,0,'C');
	        $this->Cell(25,5,"Price",1,0,'C');
	        $this->Cell(25,5,"Deal",1,0,'C');
	        $this->Ln();
	        $this->SetX(20);
	        $this->SetFont('Times','',10);
	        $no=1;
	    global $baris, $data;
	    $p=0;
	    $p2=0;
	    $sub=0;
	    	while ($look=mysqli_fetch_assoc($data)) {
	    		$p+=$look['price'];
	    		$p2+=$look['price_deal'];
	    		$sub=$p-$p2;	
		    	$this->Cell(8,5, $no , 1, 0, 'C');
	            $this->Cell(20,5, $look['category'],1, 0, 'C');
	            $this->Cell(60,5, $look['name'], 1, 0,'L');
	            $this->Cell(60,5, $look['email'],1, 0, 'L');
	            $this->Cell(30,5, $look['phone'], 1, 0,'C');
	            $this->Cell(20,5, $look['status'],1, 0, 'C');
	            $this->Cell(25,5, "Rp. ".number_format($look['price']),1, 0, 'R');
	            $this->Cell(25,5, "Rp. ".number_format($look['price_deal']),1, 0, 'R');
	            $this->ln();
	            $this->SetX(20);
	            $no++;
        	}
        	$this->Cell(198,5,"Total Penjualan",1,0,'L');
            $this->Cell(25,5, "Rp. ".number_format($p),1,0,'R');
            $this->Cell(25,5, "Rp. ".number_format($p2),1,0,'R');
            $this->ln();
	        $this->SetX(20);
        	$this->Cell(198,5,"Selisih",1,0,'L');
            $this->Cell(50,5, "Rp. ".number_format($sub),1,0,'R');



        $this->Ln(20);
        
        $this->Ln(6);
        $this->SetX(200);
        $this->SetFont('Arial','',10);
        $this->Cell(70,6,"Bandung, ".date("d M Y"),0,0,'R');
        
        $this->Ln(6);
        $this->SetX(200);
        $this->SetFont('Arial','',10);
        $this->Cell(70,6,"Bag. Keuangan,",0,0,'R');
        
        $this->Ln(30);
        $this->SetX(10);
        $this->SetX(200);
        $this->Cell(70,10,"....................................................................",0,0,'L');
        $this->Ln(5);
        $this->SetX(200);
        $this->Cell(1,10,"NIK.",0,0,'L');
	    }
	 
	    //Page footer
	    function Footer()
	    {
	        //atur posisi 1.5 cm dari bawah
	        $this->SetY(-15);
	        //buat garis horizontal
	        $this->Line(10,$this->GetY(),290,$this->GetY());
	        //Arial italic 9
	        $this->SetFont('Times','',9);
	        //nomor halaman
	        $this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
	    }
	}
	 
	//contoh pemanggilan class
	$pdf = new PDF('L','mm','A4');

	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Content();
	$pdf->Output();
}
?>