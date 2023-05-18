	<?php 
		include 'config.php';
           
		// while($o = mysqli_fetch_assoc($dataop)){
        //     $tabelop [] = $w;
        // }
        $datachart = mysqli_query($conn,"select * from datasensor");
		while($a = mysqli_fetch_assoc($datachart)){
            $tabelc [] = $a;
        }


        $datasen = mysqli_query($conn,"select * from datasensor order by id desc limit 1");
	    $s = mysqli_fetch_array($datasen);
        $T= $s ["waktu"];
        $H = $s ["evalasi"];
        $n = $s ["efisensi"];
        $daya = $s ['Egi'];
        // print_r($tabel);
        // foreach ($tabelop as $tabel):
        // echo $tabel['jam'];
        // endforeach;
        // echo $arusinpu
      
        // var_dump ($ab);
        // die;
        // echo "$row[0] $row[1] $row[2] $row[3] $row[4]";
        $notifikasi = mysqli_query($conn,"select * from notifikasi order by id desc limit 1");
        $dataw = mysqli_fetch_array($notifikasi);
        $w = $dataw ["tanggal_waktu"];
        // var_dump ($w);
        // die;
        // echo "$row[0] $row[1] $row[2] $row[3] $row[4]";
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="../dist/output.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-300">

    <!-- Header -->
    <nav id="header" class="bg-blue-500 fixed w-full z-10 top-0 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">
            <div class="w-1/2 pl-2 md:pl-0">
                <a class="text-slate-200 text-base xl:text-xl no-underline hover:no-underline font-bold" href="#" onClick="document.location.reload(true)">
                    <i class=" text-blue-400 pr-3"></i>Optimalisasi Pembangkit Listrik Tenaga Air
                    <!-- <input type="submit" value="Refresh Page" onClick="document.location.reload(true)"> -->
                </a>
            </div>
            <div class="w-1/2 pr-0">
                <div class="flex relative inline-block float-right">
                    <div class="relative text-sm text-gray-100">
                        <button id="userButton" class="flex items-center focus:outline-none mr-3">
                            <!-- <img class="w-8 h-8 rounded-full mr-4" src="http://i.pravatar.cc/300" alt="Avatar of User" /> -->
                            <span class="hidden md:inline-block text-gray-100">Operator</span>
                            <svg class="pl-2 h-2 fill-current text-gray-100" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                <g>
                                    <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                                </g>
                            </svg>
                        </button>
                        <div id="userMenu" class="bg-gray-900 rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                            <ul class="list-reset">
                                <li>
                                    <a href="#" class="px-4 py-2 block text-gray-100 hover:bg-gray-800 no-underline hover:no-underline">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="block lg:hidden pr-4">
                        <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-100 hover:border-teal-500 appearance-none focus:outline-none">
                            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Menu</title>
                                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-blue-500 z-20" id="nav-content">
                <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                    <li class="mr-6 my-2 md:my-0">
                        <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-slate-200 no-underline hover:text-slate-700 border-b-2 border-blue-400 hover:border-blue-400">
                            <i class="fas fa-home fa-fw mr-3 text-blue-400"></i><span class="pb-1 md:pb-0 text-sm">Dashboard</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-slate-200 no-underline hover:text-slate-700 border-b-2 border-gray-900 hover:border-pink-400">
                            <i class="fas fa-tasks fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">History</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-slate-200 no-underline hover:text-slate-700 border-b-2 border-gray-900 hover:border-green-400">
                            <i class="fas fa-chart-area fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Tabel</span>
                        </a>
                    </li>
                </ul>


            </div>
        </div>
    </nav>

    <!-- end of header -->
    <!-- Notifikasi -->
  
    <!-- body -->
    <div class="container w-full mx-auto pt-32 ">
        <?php $abcd = 10;
        if ($abcd == 10) : ?>
<div class="flex justify-center items-center mb-10">
  <div class="w-1/4 border-2 border-black bg-red-500 ">
    <h1 class="text-2xl mt-4 text-slate-600 font-semibold uppercase">Data Optimasi Terakhir :<?=$w?></h1>
  </div>
</div>
<?php endif; ?>
    <!-- end of notifikasi -->
        <div class="grid grid-cols-4 gap-4 ">
            <div class="border-white border-2 text-center rounded-md bg-white shadow-lg h-32">
                <h2 class="text-3xl mt-4 text-slate-600 font-semibold uppercase"> Waktu </h2>
                <div class="mt-4">
                    <p class="text-2xl text-slate-500 font-medium"><?= $T ?></p>
                </div>
            </div>
            <div class="border-white border-2 text-center rounded-md bg-white shadow-lg h-32">
                <h2 class="text-3xl mt-4 text-slate-600 font-semibold uppercase"> Head </h2>
                <div class="mt-4">
                    <p class="text-2xl text-slate-500 font-medium"><?= $H ?> </p>
                </div>
            </div>
            <div class="border-white border-2 text-center rounded-md bg-white shadow-lg h-32">
                <h2 class="text-3xl mt-4 text-slate-600 font-semibold uppercase"> Efisiensi </h2>
                <div class="mt-4">
                    <p class="text-2xl text-slate-500 font-medium"><?= $n ?> % </p>
                </div>
            </div>
            <div class="border-white border-2 text-center rounded-md bg-white shadow-lg h-32">
                <h2 class="text-3xl mt-4 text-slate-600 font-semibold uppercase"> Egi </h2>
                <div class="mt-4">
                    <p class="text-2xl text-slate-500 font-medium"><?= $daya ?> KW</p>
                </div>
            </div>
         
        </div>
        
        

        
        <!-- end of body -->
        
        <!-- table 1 -->
        <div class="grid grid-cols-2 pt-8">
            <div class="bg-gray-100">
                <div class="mt-8 text-center">
                    <h1 class="text-2xl font-bold text-slate-700"> Data dan Spesifikasi Generator</h1>
                </div>

                <div class="flex flex-col px-24">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <!-- <thead class="bg-white border-b">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Batasan Head Operasi
                                        </th>
                                        <th class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                                            06-20 CM
                                        </th>
                                    </tr>
                                </thead> -->
                                    <tbody>
                                         <tr class="bg-gray-100 border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Batasan Head Operasi</td>
                                            <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                                            60>25cm                                         
                                             </td>
                                        </tr>

                                        <tr class="bg-gray-100 border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jenis Generator</td>
                                            <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                                               Mini Hydrogenerator
                                            </td>

                                        </tr>
                                        <tr class="bg-gray-100 border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Daya Mampu Maksimal</td>
                                            <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                                                25KW
                                            </td>

                                        </tr>
                                        <tr class="bg-gray-100 border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Daya Mampu Minimal</td>
                                            <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                                                0- 12W
                                            </td>

                                        </tr>
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="bg-gray-100">
                <div class="mt-8 text-center">
                    <h1 class="text-2xl font-bold text-slate-700"> Data dan Kolam</h1>
                </div>

                <div class="flex flex-col px-24">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <!-- <thead class="bg-white border-b">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Batasan Head Operasi
                                        </th>
                                        <th class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                                            06-20 CM
                                        </th>
                                    </tr>
                                </thead> -->
                                    <tbody>
                                        
                                        <tr class="bg-gray-100 border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Luas Dasar Kolam</td>
                                            <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                                                320Cm pangkat 2
                                            </td>

                                        </tr>
                                        <tr class="bg-gray-100 border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Evalasi air Tertinggi</td>
                                            <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                                                35 CM
                                            </td>

                                        </tr>
                                        <tr class="bg-gray-100 border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Evalasi Air Terendah</td>
                                            <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                                                10 Cm
                                            </td>

                                        </tr>
                                        <tr class="bg-gray-100 border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Volume Efektif</td>
                                            <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                                                84 m kubik
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="mt-8 text-center">
            <h1 class="text-4xl font-bold text-slate-700"> Tabel Hasil Optimalisasi 24 jam</h1>
        </div>
        <!-- end of table 1 -->
        <!-- table2 -->
        <div class="container w-full md:w-4/5 xl:w-3/5  mx-auto mt-8  bg-slate-200">


            <div id='recipients' class="mt-6 lg:mt-0  ">
                <?php
    // memanggil file "header.php"
                require 'datamax.php';
                ?>
                

                <!-- <table id="example" class="stripe hover " style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Jam</th>
                            <th data-priority="2">H</th>
                            <th data-priority="3">Q1</th>
                            <th data-priority="4">n</th>
                            <th data-priority="5">Egi</th>
                         
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach ($data as $o) :  ?>

                      <tr>
                            <td class="text-center"><?= $o["waktu"] ?></td>
                            <td class="text-center"><?= $o["evalasi"] ?></td>
                            <td class="text-center"><?= $o["arus"] ?></td>
                            <td class="text-center"><?= $o["efisensi"] ?></td>
                            <td class="text-center"><?= $o["Egi"] ?></td>
                            
                                                    </tr>
                        <?php endforeach; ?>
                       

                    </tbody>

                </table> -->


            </div>
            <!--/Card-->




        </div>
        <!--end of table 2 -->
    

        <!-- Chart -->
        <div class="bg-gray-100 mt-8">
            <div>
                <div class="mt-8 text-center">
                    <h1 class="text-2xl font-bold text-slate-700"> Grafik Evalasi Selama 24 Jam</h1>
                    <?php
    // memanggil file "header.php"
                require 'datagrafik.php';
                ?>     </div>
                <div class="shadow-lg rounded-lg overflow-hidden">
                
    </div>
   
                   
</div>
    <!-- end of chart -->
    <!-- Required chart.js -->

    </div>
    </div>
</body>

</html>