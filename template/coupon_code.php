<?php
function mcp_formatDate(){
$date = date('Y-m-d'); // now date
$date = date('Y-m-d', strtotime('+30 days', strtotime($date))); //operasi penjumlahan

	$bulan = array (
		1	=>	'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $date);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

if(empty($code)){
	$note="Mohon maaf, Ada masalah server.<br>kode kupon yang tertera tidak asli. mohon hubungi CS Malika";
	$code="adsggt19";
}else{
	$note="Berikut Kode Kupon Anda";	
}

$date = mcp_formatDate();
?>
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Kode Voucher - Promo Eksklusif Malika</title>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <style>
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; 
      }
      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; 
      }
      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; 
      }
      .body {
        background-color: #f6f6f6;
        width: 100%; 
      }
      .container {
        display: block;
        Margin: 0 auto !important;
        max-width: 580px;
        padding: 10px;
        width: 580px; 
      }
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; 
      }
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; 
      }
      .wrapper {
        box-sizing: border-box;
        padding: 20px 70px; 
      }
      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }
      .footer {
        clear: both;
        Margin-top: 10px;
        text-align: center;
        width: 100%; 
      }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; 
      }
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px; 
      }
      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; 
      }
      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        margin-bottom: 15px; 
      }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; 
      }

      a {
        color: #3498db;
        text-decoration: underline; 
      }
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; 
      }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; 
      }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; 
      }
      .btn-primary table td {
        background-color: #3498db; 
      }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; 
      }
      .last {
        margin-bottom: 0; 
      }
      .first {
        margin-top: 0; 
      }
      .align-center {
        text-align: center; 
      }
      .align-right {
        text-align: right; 
      }
      .align-left {
        text-align: left; 
      }
      .clear {
        clear: both; 
      }
      .mt0 {
        margin-top: 0; 
      }
      .mb0 {
        margin-bottom: 0; 
      }
      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; 
      }
      .powered-by a {
        text-decoration: none; 
      }
      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; 
      }
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; 
        }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; 
        }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; 
        }
        table[class=body] .content {
          padding: 0 !important; 
        }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; 
        }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; 
        }
        table[class=body] .btn table {
          width: 100% !important; 
        }
        table[class=body] .btn a {
          width: 100% !important; 
        }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; 
        }
      }
      @media all {
        .ExternalClass {
          width: 100%; 
        }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; 
        }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; 
        }
        .btn-primary table td:hover {
          background-color: #34495e !important; 
        }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; 
        } 
      }
	span.mcp_kode_kupon {
		display: -webkit-inline-box;
		background-color: #90c42f;
		padding: 5px 15px;
		text-transform: uppercase;
		color: #fff;
		margin: 2px;
		font-size: 16pt;
		font-weight: bold;
		font-family: cursive;
		border-radius: 5px;
		background-repeat: repeat-y;
		background: -webkit-linear-gradient(left, #90c42f, #90c42f7a);
	}
	.mcp_foot_icon {
		display: block;
		width: 130px;
		padding: 3px 0px;
		font-size: 8pt;
		float: left;
		color: #666;
	}
	div.mcp_foot_icon a {
		color: #666;
		text-decoration: none;
	}
	div.mcp_foot_icon i {
		font-size: 10pt;
		color: #90c42f;
	}
    </style>
  </head>
  <body class="">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader"></span>
            <table role="presentation" class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="text-align:center">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <div style="background-color: #90c42f;color:#fff;margin: -20px 0px 25px;padding: 20px 0px 2px;border-radius: 8px;">
							<div style="font-size: 22px;margin-bottom: -8px;text-transform: uppercase;">Diskon</div>
							<div style="font-size: 30px;text-transform: uppercase;font-weight: bold;">Voucher</div>
						</div>
                        <p><b>Hallo guys, www.malika.id mengadakan promo diskon nih, 20% voucher belanja di official store.</b></p>
						<p><b>Syarat & Ketentuan</b><br>
						Kupon ini berlaku untuk semua akun pengguna yang telah terdaftar atau pun yang belum terdaftar di www.malika.id.<br>Jika Kamu belum daftar, harus log in dulu ya. <br> Promo ini berlaku selama periode 7-31 Januari 2019 untuk pembelanjaan produk di www.malika.id.<br>Satu pengguna hanya bisa mengikuti promo ini sebanyak 1 (satu) kali transaksi selama periode promo. Diskon hanya berlaku untuk all product paper printing saja.<br>Kunjungi toko lalu masukkan kode disaat checkout, kode akan dikirimkan ke email anda.
						</p>
						<div style="color:#90c42f;"><?php echo $note ;?></div>
						<p></p>
						<div>
						<?php
							$pj_word = strlen($code);
							for($i=0;$i<$pj_word;$i++){
								echo '<span class="mcp_kode_kupon">'.substr($code,$i,1).'</span>';
							}
						?>
						</div>
						<p></p>
						<div>Masa Berlaku Kupon Anda sampai : <?php echo $date ;?></div>
						<p></p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="center">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td style="background-color:#333"> <a style="border:solid 1px #333;background-color:#333;color:#fff" href="https://malika.id/shop" target="_blank">Let's Shop</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p style="font-size: 10pt;color: #cfcfcf;"><i>Jika ada kendala silahkan menghubungi kami</i></p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
				<!-- custom footer -->
			  <tr>
					<td style="text-align: center;padding: 15px;">
						<div class="mcp_foot_icon">	
							<a href="https://api.whatsapp.com/send?phone=6281266006161&text=Halo%20mau%20tanya%20tentang%20produk%20malika%20?%20" target="_blank">
								<i class="fab fa-whatsapp" color="#90c42f"></i>  +6281266006161
							</a>
						</div>
						<div class="mcp_foot_icon">
							<a href="https://malika.id" target="_blank">
								<i class="fas fa-globe" color="#90c42f"></i> malika.id
							</a>
						</div>
						<div class="mcp_foot_icon">
							<a href="mailto:admin@malika.id" target="_blank">
								<i class="far fa-envelope" color="#90c42f"></i> admin@malika.id
							</a>
						</div>
						<div class="mcp_foot_icon">	
							<a href="https://www.facebook.com/malikawallart/" target="_blank">
								<i class="fab fa-facebook-square" color="#90c42f"></i>
							</a>
							<a href="https://www.instagram.com/malikawallart/" target="_blank">
								<i class="fab fa-instagram" color="#90c42f"></i>
							</a>
							<a href="https://www.youtube.com/channel/UCMGCCX3XYhZGqf_sry5ik-w" target="_blank">
								<i class="fab fa-youtube" color="#90c42f"></i>
							</a>
								 malikawallart
						</div>
					</td>
				</tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class="footer">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">Jl. Slamet Raya RT04 RW34, Tawangsari, Mojosongo, Surakarta, Jawa Tengah</span>
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
                    Powered by <a href="https://malika.id">Malika.id</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
