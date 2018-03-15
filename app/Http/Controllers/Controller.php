<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Colleges List
    const colleges_list = array(
    	'1' => 'A.C. College of Engineering and Technology, Karaikudi',
    	'2' => 'Aalim Muhammed Salegh College of Engineering, Chennai',
    	'3' => 'Aarupadai Veedu Institute of Technology, Vinayaka Mission University, Chennai',
    	'4' => 'ABES Engineering College , Ghaziabad',
    	'5' => 'Acharya Institute of Technology, Bangalore',
    	'6' => 'Acharya Nagarjuna University, Guntur',
    	'7' => 'Acropolis Institute of Technology and Research, Indore',
    	'8' => 'Adhi College of Engineering and Technology, Chennai',
    	'9' => 'Adhiparasakthi college of engineering, Kancheepuram',
    	'10' => 'Adhiyamaan College of Engineering, Hosur',
    	'11' => 'Adi Shankara Institute of Engineering & Technology, Ernakulam',
    	'12' => 'Adithya Institute of Technology, Coimbatore',
    	'13' => 'Aditya College Of Engineering, Madanapalli',
    	'14' => 'Aditya Institute of Management Studies and Research, Mumbai',
    	'15' => 'Alagappa Chettiar College of Engineering and Technology, Karaikudi',
    	'16' => 'Al-Ameen Engineering College, Erode',
    	'17' => 'Al-Ameer College of Engineering and IT, Visakhapatnam',
    	'18' => 'Alpha College of Engineering, Kurnool',
    	'19' => 'Amrita Vishwa Vidyapeetham, Amritapuri, Kollam',
    	'20' => 'Amrita Vishwa Vidyapeetham, Bengaluru',
    	'21' => 'Amrita Vishwa Vidyapeetham, Coimbatore',
    	'22' => 'Andhra University, Visakhapatnam',
    	'23' => 'Anil Neerukonda Institute Of Technology and Science (ANITS), Visakhapatnam',
    	'24' => 'Anna University - BIT Campus Tiruchirappall',
    	'25' => 'Annamacharya Institute of Technology and Sciences, Tirupati',
    	'26' => 'Apollo Priyadarshanam Institute of Technology, Chennai',
    	'27' => 'Army Institute of Management and Technology, Noida',
    	'28' => 'Arunai Engineering College, Tiruvannamalai',
    	'29' => 'Avanthi Institute of Engineering and Technology, Visakhapatnam',
    	'30' => 'B.S.Abdur Rahman University, Chennai',
    	'31' => 'Bangalore Institute of Management Studies (BIMS)',
    	'32' => 'Bannari Amman Institute of Technology, Sathyamangalam, Erode',
    	'33' => 'Bapatla Engineering College, Andhra Pradesh',
    	'34' => 'Bharat Institute of Engineering and Technology, Hyderabad',
    	'35' => 'Bharath University, Chennai',
    	'36' => 'Bharathidasan Institute of Management, Trichy',
    	'37' => 'Bharathidasan University, Trichy',
    	'38' => 'Bharathiyar College of Engineering and Technology, Puducherry',
    	'39' => 'Bishop Heber College, Trichy',
    	'40' => 'BITS Pilani Hyderabad Campus',
    	'41' => 'BITS Pilani K.K. Birla Goa Campus',
    	'42' => 'BMS Engineering College, Bangalore',
    	'43' => 'BNM Institute of Technology, Bangalore',
    	'44' => 'Brindavan Institute of Technology and Science, Kurnool',
    	'45' => 'BSA Crescent Engineering College, Chennai',
    	'46' => 'CARE College of Engineering, Trichy',
    	'47' => 'CARE School of Engineering, Trichy',
    	'48' => 'Chettinad College of Engineering and Technology, Karur',
    	'49' => 'Christ College of Engineering and Technology, Puducherry',
    	'50' => 'CMR Engineering College , Hyderabad',
    	'51' => 'CMR Institute of Technology, Bangalore',
    	'52' => 'Cochin University of Science and Technology (CUSAT)',
    	'53' => 'Coimbatore Institute of Engineering and Technology (CIET)',
    	'54' => 'Coimbatore Institute of Technology',
    	'55' => 'College of Engineering and Technology, Bhubaneswar',
    	'56' => 'College of Engineering, Guindy, Chennai',
    	'57' => 'College of Engineering, Trivandrum',
    	'58' => 'CSI College of Engineering, Ooty',
    	'59' => 'CVSR College, Hyderabad',
    	'60' => 'Dayanand Sagar College of Engineering, Bangalore',
    	'61' => 'Dhanalakshmi Srinivasan College of Engineering and Technology, Chennai',
    	'62' => 'Dhanalakshmi Srinivasan Engineering College, Trichy',
    	'63' => 'Dhanalakshmi Srinivasan Institute of Technology, Trichy',
    	'64' => 'Dhirajlal Gandhi College Of Technology, Salem',
    	'65' => 'Dr. Mahalingam College of Engineering and Technology, Pollachi',
    	'66' => 'Dr. N.G.P. Institute of Technology, Coimbatore',
    	'67' => 'Easwari Engineering College, Chennai',
    	'68' => 'EGS Pillay Engineering College, Nagapattinam',
    	'69' => 'Engineering College, Barton hill, Trivandrum',
    	'70' => 'Erode Builder Educational Trust\'s Group of Institution',
    	'71' => 'Erode Sengunthar Engineering College, Thudupathi',
    	'72' => 'Ethiraj College for Women, Chennai',
    	'73' => 'Excel Engineering College, Namakkal',
    	'74' => 'Federal Institute of Science and Technology (FISAT), Cochin',
    	'75' => 'Francis Xavier Engineering College, Tirunelveli',
    	'76' => 'G. Narayanamma Institute of Technology and Science, Hyderabad',
    	'77' => 'G.Pulla Reddy Engineering College, Kurnool',
    	'78' => 'Gayatri Vidya Parishad College Of Engineering, Visakhapatnam',
    	'79' => 'Geethanjali Institute of Science and Technology, Nellore',
    	'80' => 'Ghousia College of Engineering, Ramanagara',
    	'81' => 'GITAM Institute of Technology, Hyderabad',
    	'82' => 'GITAM Institute of Technology, Visakhapatnam',
    	'83' => 'GITAM School of Technology, Bangalore',
    	'84' => 'Gnanamani College of Technology, Namakkal',
    	'85' => 'Government College of Engineering, Salem',
    	'86' => 'Government College of Engineering, Srirangam',
    	'87' => 'Government College of Engineering, Thanjavur',
    	'88' => 'Government College of Engineering, Tirunelveli',
    	'89' => 'Government College of Technology, Coimbatore',
    	'90' => 'Government Engineering College, Calicut',
    	'91' => 'Government Engineering College, Kannur',
    	'92' => 'Government Engineering College, Thrissur',
    	'93' => 'Government Engineering College, Trivandrum',
    	'94' => 'Government Model Engineering College, Cochin',
    	'95' => 'Gyan Ganga College of Technology, Jabalpur',
    	'96' => 'Hindustan College of Engineering , Chennai',
    	'97' => 'Hindusthan College of Engineering and Technology, Coimbatore',
    	'98' => 'Hindusthan Institute of Technology, Coimbatore',
    	'99' => 'Indian Institute of Information Technology Design and Manufacture, Kancheepuram',
    	'100' => 'Indian Institute of Information Technology, Bhubaneswar',
    	'101' => 'Indian Institute of Information Technology, Srirangam',
    	'102' => 'Indian Institute of Information Technology, Trichy',
    	'103' => 'Indian Institute of Management Bangalore',
    	'104' => 'Indian Institute of Management, Trichy',
    	'105' => 'Indian Institute of Science, Education and Research (IISER), Trivandrum',
    	'106' => 'Indian Institute of Space Science and Technology, Trivandrum',
    	'107' => 'Indian Institute of Technology, Chennai',
    	'108' => 'Indian Institute of Technology, Palakkad',
    	'109' => 'Indian Institute of Technology, Tirupati',
    	'110' => 'Info Institute of Engineering, Coimbatore',
    	'111' => 'Institute of Aeronautical Engineering, Hyderabad',
    	'112' => 'Institute of Road and Transport Technology, Erode',
    	'113' => 'International Institute of Information Technology, Bangalore',
    	'114' => 'International Institute of Information Technology, Hyderabad',
    	'115' => 'J J College of Engineering and Technology, Trichy',
    	'116' => 'Jamal Mohamed College, Trichy',
    	'117' => 'Jamna Lal Bajaj Institute of Management Studies, Mumbai',
    	'118' => 'Jansons Institute of Technology, Coimbatore',
    	'119' => 'Jawahar Engineering College, Chennai',
    	'120' => 'Jawaharlal Nehru Technological University (JNTU), Anantapur',
    	'121' => 'Jawaharlal Nehru Technological University (JNTU), Hyderabad',
    	'122' => 'Jaya Engineering College, Chennai',
    	'123' => 'Jayalakshmi Institute of Technology, Thoppur',
    	'124' => 'Jayaraj Annapackiam CSI College of Engineering, Tuticorin',
    	'125' => 'Jeppiaar Engineering College, Chennai',
    	'126' => 'JNTU College of Engineering, Pulivendula',
    	'127' => 'JNTUA College of Engineering, Kalikiri',
    	'128' => 'JNTUK University College Of Engineering, Vizianagaram',
    	'129' => 'K Ramakrishnan College of Technology, Trichy',
    	'130' => 'K S Rangasamy College of Engineering, Tiruchengode',
    	'131' => 'K S Rangasamy College of Technology, Tiruchengode',
    	'132' => 'K. L. N College Of Engineering, Madurai',
    	'133' => 'K. Ramakrishnan College of Engineering, Trichy',
    	'134' => 'K. S. R Institute for Engineering and Technology, Tiruchengode',
    	'135' => 'Kakatiya Institute of Technology and Science, Warangal',
    	'136' => 'Kalaignar Karunanidhi Institute of Technology, Coimbatore',
    	'137' => 'Kalasalingam Institute of Technology, Virudhunagar',
    	'138' => 'Kalasalingam University, Virudhunagar',
    	'139' => 'Kalinga Institute of Industrial Technology, Bhubaneswar',
    	'140' => 'Kamaraj College of Engineering and Technology, Virudhunagar',
    	'141' => 'Karpagam College of Engineering, Coimbatore',
    	'142' => 'Karpagam Institute Of Technology, Coimbatore',
    	'143' => 'Karunya Institute of Technology and Sciences, Coimbatore',
    	'144' => 'Kathir College of Engineering, Coimbatore',
    	'145' => 'KCG College of Technology, Chennai',
    	'146' => 'KGISL Institute Of Technology, Coimbatore',
    	'147' => 'Kings College of Engineering, Chennai',
    	'148' => 'Kings College of Engineering, Pudukottai',
    	'149' => 'KITS, Warangal',
    	'150' => 'KLN College of Information Technology, Madurai',
    	'151' => 'KMM Institute of Technology and Science, Tirupati',
    	'152' => 'Knowledge Institute of Technology(KIOT), Salem',
    	'153' => 'Kongu Engineering College, Erode',
    	'154' => 'Kongunadu College of Engineering and Technology, Trichy',
    	'155' => 'KPR Institute of Engineering and Technology, Coimbatore',
    	'156' => 'Krishnasamy College of Engineering and Technology, Cuddalore',
    	'157' => 'KS School of Engineering and Management, Bangalore',
    	'158' => 'Kumaraguru College of Technology, Coimbatore',
    	'159' => 'Latha Mathavan Engineering College, Madurai',
    	'160' => 'LBS Institute of Technology for Women, Trivandrum',
    	'161' => 'M.A.M College of Engineering & Technology, Trichy',
    	'162' => 'M.A.M School of Engineering, Trichy',
    	'163' => 'M.Kumarasamy College Of Engineering, Karur',
    	'164' => 'M.S. Ramaiah Institute of Technology (MSRIT), Bangalore',
    	'165' => 'Maamallan Institute of Technology, Sriperumbudur',
    	'166' => 'Madanapalle Institute of Technology and Science (MITS) ,Chittoor',
    	'167' => 'Madha Engineering College, Chennai',
    	'168' => 'Madha Institute of Engineering and Technology, Chennai',
    	'169' => 'Madras Institute of Technology (MIT), Anna University, Chennai',
    	'170' => 'Madurai Kamaraj University (Arts & Science College)',
    	'171' => 'Maharaj Vijayaram Gajapathi Raj (MVGR) College of Engineering, Vizianagaram',
    	'172' => 'Mahath Amma Institute of Engineering & Technology, Pudukkottai',
    	'173' => 'Mahatma Gandhi Institute of Technology (MGIT), Hyderabad',
    	'174' => 'Mahendra Engineering College, Namakkal',
    	'175' => 'Mahendra Institute of Technology, Namakkal',
    	'176' => 'MAM College of Engineering, Trichy',
    	'177' => 'Manipal Institute of Technology',
    	'178' => 'Mar Athanasius College of Engineering, Kothamangalam',
    	'179' => 'Mar Baselios College of Engineering and Technology,Thiruvananthapuram',
    	'180' => 'Meenakshi Ramaswamy Engineering College, Ariyalur',
    	'181' => 'Meenakshi Sundararajan Engineering college, Chennai',
    	'182' => 'Mepco Schlenk Engineering College, Sivakasi',
    	'183' => 'MIET Engineering College, Trichy',
    	'184' => 'MNM Jain Engineering College, Chennai',
    	'185' => 'Model Engineering College, Cochin',
    	'186' => 'Mohamed Sathak Engineering College, Ramnathapuram',
    	'187' => 'Mohandas college of Engineering and Technology,Trivandrum',
    	'188' => 'Moogambigai College of Engineering, Trichy',
    	'189' => 'Mookambigai College of Engineering, Pudukkottai',
    	'190' => 'Motilal Nehru National Institute of Technology, Allahabad',
    	'191' => 'Muthoot Institute of Technology and Science(MITS), Ernakulam',
    	'192' => 'MVJ College of Engineering, Bangalore',
    	'193' => 'MVSR Engineering College, Hyderabad',
    	'194' => 'N.B.K.R.Institute of Science and Technology,Vidyanagar,Nellore',
    	'195' => 'N.P.R College of Engineering and Technology, Dindigul',
    	'196' => 'Nandha College of Technology Erode',
    	'197' => 'Nandha Engineering College, Erode',
    	'198' => 'Narasu\'s Sarathy Institute of Technology, Salem',
    	'199' => 'Narayana Engineering College, Nellore',
    	'200' => 'National Engineering college, Kovil Patti',
    	'201' => 'National Institute of Engineering, Mysore',
    	'202' => 'National Institute of Technology, Calicut',
    	'203' => 'National Institute of Technology, Puducherry',
    	'204' => 'National Institute of Technology, Silchar',
    	'205' => 'National Institute of Technology, Surathkal, Karnataka',
    	'206' => 'National Institute of Technology, Tiruchirappalli',
    	'207' => 'National Institute of Technology, Warangal',
    	'208' => 'NES Ratnam College of Arts, Science and Commerce, Mumbai',
    	'209' => 'Nitte Meenakshi Institute of Technology, Bangalore',
    	'210' => 'NMIMS, Bangalore',
    	'211' => 'NPR College of Engineering & Technology (NPRCET), Dindigul',
    	'212' => 'NSS College of Engineering, Palakkad',
    	'213' => 'Osmania University, Hyderabad',
    	'214' => 'Oxford Engineering College, Trichy',
    	'215' => 'P. R. Engineering College (PREC), Thanjavur',
    	'216' => 'P.M.R Engineering College, Chennai',
    	'217' => 'P.T.R college of engineering and technology, Madurai',
    	'218' => 'Paavai College of Technology, Namakkal',
    	'219' => 'Paavai engineering College, Namakkal',
    	'220' => 'Panimalar Engineering College, Chennai',
    	'221' => 'Panimalar Institute of Technology, Chennai',
    	'222' => 'Parisutham Institute of Technology and Science(PITS), Thanjavur',
    	'223' => 'Periyar Maniammai University- School of Architecture, Engineering and Technology, Thanjavur',
    	'224' => 'Perunthalaivar Kamarajar Institute of Engineering and Technology, Puducherry',
    	'225' => 'PES - Main University, Bangalore',
    	'226' => 'PES South Campus, Bangalore',
    	'227' => 'Podhigai College of Engineering & Technology, Vellore',
    	'228' => 'Pondicherry Engineering College',
    	'229' => 'Pondicherry University',
    	'230' => 'Prasad V Potluri (PVP) Siddhartha Institute of Technology, Vijayawada',
    	'231' => 'Prathyusha Institute of Technology and Management, Thriuvallur',
    	'232' => 'PRIST University, Thanjavur',
    	'233' => 'PSG College of Arts and Science, Coimbatore',
    	'234' => 'PSG College of Technology, Coimbatore',
    	'235' => 'PSG Institute of Technology and Applied Research, Coimbatore',
    	'236' => 'PSG Polytechnic College, Coimbatore',
    	'237' => 'PSNA College of Engineering and Technology (PSNA CET), Dindigul',
    	'238' => 'PSR Engineering College, Sivakasi',
    	'239' => 'R V R & J C College of Engineering(Rayapati Venkata Rangarao & Jagarlamudi Chandramouli), Guntur',
    	'240' => 'R.M.K. College of Engineering & Technology(RMKCET), Tiruvallur, Chennai',
    	'241' => 'Rajagiri School of Engineering and Technology, Cocnhi',
    	'242' => 'Rajalakshmi Engineering College , Chennai',
    	'243' => 'Rajalakshmi Institute of Technology, Kancheepuram',
    	'244' => 'Rajeev Gandhi Memorial College of Engineering and Technology, Kurnool',
    	'245' => 'Rajiv Gandhi College of Engineering and Technology (RGCET), Puducherry',
    	'246' => 'Rajiv Gandhi Institute of Technology, Kottayam',
    	'247' => 'Ramco Institute of Technology, Chennai',
    	'248' => 'Rashtreeya Vidyalaya College of Engineering (RV College of Engineering), Bangalore',
    	'249' => 'RMD Engineering College, Chennai',
    	'250' => 'RNS Institute of Technology, Bangalore',
    	'251' => 'RRASE College of Engineering, Padapai, Chennai',
    	'252' => 'RVS College of Engineering and Technology, Coimbatore',
    	'253' => 'SACS MAVMM Engineering College, Madurai',
    	'254' => 'Sahyadri College of Engineering and Management, Mangalore',
    	'255' => 'Saranathan College of Engineering, Trichy',
    	'256' => 'Sardar Vallabhbhai National Institute of Technology (SVNIT), Gujarat',
    	'257' => 'SASTRA University(Shanmugha Arts, Science, Technology & Research Academy), Thanjavur',
    	'258' => 'Sathyabama University/Sathyabama Institute of Science and Technology, Chennai',
    	'259' => 'Saveetha Engineering College, Chennai',
    	'260' => 'SBM College of Engineering and Technology, Dindigul',
    	'261' => 'SCMS School Of Engineering And Technology, Cochin',
    	'262' => 'Sengunthar College Of Engineering, Salem',
    	'263' => 'Sethu Institute Of Technology, Virudhunagar',
    	'264' => 'Shanmugha Polytechnic College, Thanjavur',
    	'265' => 'Sheila Raheja School of Business Management and Research(SRBS), Mumbai',
    	'266' => 'Shivani College of Engineering and Technology, Trichy',
    	'267' => 'Shivani Engineering College, Trichy',
    	'268' => 'SJB Institute of Technology, Bangalore',
    	'269' => 'SKP Engineering College(SKPEC), Tiruvannamalai',
    	'270' => 'SNS College of Technology, Coimbatore',
    	'271' => 'Sona College of Technology, Salem',
    	'272' => 'Sree Chitra Thirunal College of Engineering, Trivandrum',
    	'273' => 'Sree Chitra Thirunal College of Engineering, Trivandrum',
    	'274' => 'Sree Rama Engineering College, Tirupati',
    	'275' => 'Sree Vidyanikethan Engineering College, Tirupati',
    	'276' => 'Sri Eshwar College of Engineering, Coimbatore',
    	'277' => 'Sri Krishna College of Engineering & Technology (SKCET), Coimbatore',
    	'278' => 'Sri Krishna College Of Technology(SKCT), Coimbatore',
    	'279' => 'Sri Manakula Vinayagar Engineering College, Puducherry',
    	'280' => 'Sri Muthukumaran Institute Of Technology (SMIT), Chennai',
    	'281' => 'Sri Muthukumaran Institute of technology, Chennai',
    	'282' => 'Sri Ramakrishna Engineering College, Coimbatore',
    	'283' => 'Sri Ramakrishna Institute of technology, Coimbatore',
    	'284' => 'Sri Sairam Engineering College, Tambaram',
    	'285' => 'Sri Shakthi Institute of Engineering and Technology, Coimbatore',
    	'286' => 'Sri Sivasubramaniya Nadar College (SSN) of Engineering, Chennai',
    	'287' => 'Sri Venkateshwara College of Engineering(SVCE), Chennai',
    	'288' => 'Sri Venkateswara College of Engineering Technology, Chittoor',
    	'289' => 'Sri Venkateswara University, Tirupati',
    	'290' => 'Sriram Engineering College, Chennai',
    	'291' => 'SRM University, Chennai',
    	'292' => 'SSM College of Engineering, Namakkal',
    	'293' => 'St Xaviers Catholic College of Engineering, Nagercoil',
    	'294' => 'St. Joseph\'s College of Engineering and Technology, Palai',
    	'295' => 'St. Joseph\'s College of Engineering and Technology, Thanjavur',
    	'296' => 'St. Joseph\'s Institute of Technology, Chennai',
    	'297' => 'St. Peter\'s Institute of Higher Education and Research, Thiruvallur',
    	'298' => 'Syed Ammal Engineering college, Ramanathapuram',
    	'299' => 'Symbiosis Institute of Technology, Pune',
    	'300' => 'Tagore Engineering College, Chennai',
    	'301' => 'Tamilnadu College of Engineering, Coimbatore',
    	'302' => 'Thiagarajar College of Engineering, Madurai',
    	'303' => 'Thiagarajar School of Management, Madurai',
    	'304' => 'TKM College of Engineering, Kollam',
    	'305' => 'Toc H Institute of Science And Technology, Cochin',
    	'306' => 'TRP Engineering College, Trichy',
    	'307' => 'Ultra College of Engineering and Technology for Women, Madurai',
    	'308' => 'University College of Engineering Panruti',
    	'309' => 'University College of Engineering, Thirukkuvalai, Nagapattinam',
    	'310' => 'Vaghdevi College, Warangal',
    	'311' => 'Vaigai college of engineering, Madurai',
    	'312' => 'Valliammai Engineering College, Kanchipuram',
    	'313' => 'Vasireddy Venkatadri Institute of Technology, Guntur',
    	'314' => 'Vel Tech High Tech, Dr.Rangarajan Dr.Sakunthala Engineering College, Chennai',
    	'315' => 'Vel Tech University, Chennai',
    	'316' => 'Velagapudi Ramakrishna Siddhartha Engineering College, Vijayawada',
    	'317' => 'Velalar College of Engineering and Technology, Erode',
    	'318' => 'Velammal college of engineering and technology, Madurai',
    	'319' => 'Velammal Engineering College, Chennai',
    	'320' => 'Velammal Institute of Technology, Chennai',
    	'321' => 'Vels Institute of Science, Technology & Advanced Studies, Pallavaram',
    	'322' => 'Vetri Vinayaha College of Engineering and Technology, Trichy',
    	'323' => 'Vickram College of Engineering, Madurai',
    	'324' => 'Vidya Jyothi Institute of Technology, Hyderabad',
    	'325' => 'Vidya Jyothi Institute of Technology, Hyderbad',
    	'326' => 'Vignan University, Vadlamudi',
    	'327' => 'Vignan\'s Institute Of Information Technology (VIIT), Visakhapatnam',
    	'328' => 'Vimal Jyothi Engineering College, Kannur',
    	'329' => 'Vinayaka Mission\'s Kirupananda Variyar Engineering College, Salem',
    	'330' => 'Vishweswara College of Engineering, Bangalore',
    	'331' => 'Visvesvaraya National Institute of Technology (VNIT), Nagpur',
    	'332' => 'Visvodaya Engineering College, Nellore',
    	'333' => 'Viswajyothi College of Engineering and Technology (VJCET), Cochin',
    	'334' => 'VIT University, Chennai',
    	'335' => 'VIT University, Vellore',
    	'336' => 'VSA School of Engineering, Salem',
    	'337' => 'VSA School of Management, Salem',
    	'338' => 'VSB Engineering College, Karur',
    	'339' => 'VV College of Engineering, Tirunelveli',
    	'340' => 'Xavier Labour Relations Institute, Jamshedpur',
    );

    // States List
    const states_list = array(
      '1' => 'Andra Pradesh',
      '2' => 'Arunachal Pradesh',
      '3' => 'Assam',
      '4' => 'Bihar',
      '5' => 'Chhattisgarh',
      '6' => 'Goa',
      '7' => 'Gujarat',
      '8' => 'Haryana',
      '9' => 'Himachal Pradesh',
      '10' => 'Jammu and Kashmir',
      '11' => 'Jharkhand',
      '12' => 'Karnataka',
      '13' => 'Kerala',
      '14' => 'Madya Pradesh',
      '15' => 'Maharashtra',
      '16' => 'Manipur',
      '17' => 'Meghalaya',
      '18' => 'Mizoram',
      '19' => 'Nagaland',
      '20' => 'Orissa',
      '21' => 'Punjab',
      '22' => 'Rajasthan',
      '23' => 'Sikkim',
      '24' => 'Tamil Nadu',
      '25' => 'Telangana',
      '26' => 'Tripura',
      '27' => 'Uttaranchal',
      '28' => 'Uttar Pradesh',
      '29' => 'West Bengal',
      '30' => 'Andaman and Nicobar Islands',
      '31' => 'Chandigarh',
      '32' => 'Dadra and Nagar Haveli',
      '33' => 'Daman and Diu',
      '34' => 'Lakshadweep',
      '35' => 'New Delhi',
      '36' => 'Puducherry'
    );

    // Departments list
    const dept_list = array(
      'ac' => 'Agriculture and Bio Sciences',
      'ae' => 'Aerospace Engineering',
      'bt' => 'Bio Technology',
      'bi' => 'Bio Informatics',
      'ce' => 'Civil Engineering',
      'cse' => 'Computer Science',
      'ece' => 'Electronics and Communication',
      'eee' => 'Electrical and Eclectronics',
      'eie' => 'Electronics and Instrumentation',
      'fp' => 'Food Processing',
      'me' => 'Mechanical Engineering',
      'emt' => 'Media and Communication',
      'ksm' => 'School of Management',
      'snh' => 'Science and Humanities'
    );

    // Departments list for workshops
    const dept_list_workshop = array(
      'ac' => 'Department of Agriculture',
      'ae' => 'Aerospace Engineering',
      'bt' => 'Bio Technology',
      'bi' => 'Bio Informatics',
      'ce' => 'Civil Engineering',
      'cse' => 'Computer Science',
      'ece' => 'Electronics and Communication',
      'eee' => 'Electrical and Eclectronics',
      'eie' => 'Electronics and Instrumentation',
      'fp' => 'Food Processing',
      'me' => 'Mechanical Engineering',
      'emt' => 'Media and Communication',
      'nano' => 'Nano Technology',
      'phy' => 'Physics',
      // 'chem' => 'Chemistry',
      // 'math' => 'Maths',
      'snh' => 'Science and Humanities'
    );

    // Event Types
    const event_type = array(
      'tech' => 'Technical',
      'nontech' => 'Non Technical'
    );

    // Event Categories
    const event_category = array(
      'event' => 'Event',
      'workshop' => 'Workshop',
      'game' => 'Games'
    );

    // Checks if provided userid is an authentic user
    public static function checkUserId($uid)
    {
      $prefix = env('DB_VIEW_PREFIX', '');
      $user = DB::select('select * from '.$prefix.'enduser where id=\''.$uid.'\'');

      if (count($user) > 0) {
        return true;
      }

      return false;

    }

    // Checks authernication of admin user
    public static function checkAdmin($uname)
    {
      $prefix = env('DB_VIEW_PREFIX', '');
      $user = DB::select('select * from '.$prefix.'cpanel_users where username=\''.$uname.'\'');

      if (count($user) > 0) {
        return true;
      }

      return false;

    }

    public function getChatMessages()
    {

      $prefix = env('DB_VIEW_PREFIX', '');
      $messages = DB::select('select * from '.$prefix.'news_feed');

      $acc = '{ "messages":[';

      for ($i=0; $i < count($messages); $i++) {
        if ($i == count($messages) - 1) {
          $acc .= json_encode($messages[$i]->message);
        }
        else {
          $acc .= json_encode($messages[$i]->message).', ';
        }
      }

      $acc .= ']}';

      return $acc;

    }

    // Generates a 16-digit alpha-numeric
    public function generateRandomString($length = 16) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
      }

      return $randomString;
    }

    // Mini slugify function
    public static function slugify($string, $delimiter = '-')
    {
      $string = preg_replace('#[^\pL\d]+#u', '-', $string);
      // Trim trailing "-"
      $string = trim($string, '-');
      $clean = preg_replace('~[^-\w]+~', '', $string);
      $clean = strtolower($clean);
      $clean = preg_replace('#[\/_|+ -]+#', $delimiter, $clean);
      $clean = trim($clean, $delimiter);
      return $clean;
    }

    public function nl_replace($string)
    {
      // return str_replace(array("\r", "\n", "\r\n", "\n\r"), '<br>', $string);
      return $string;
    }


    // Check if User is Verified
    public static function checkUserStatus($id)
    {
      if (count(DB::select('select * from mindkraft18_approved_enduser where id=\''.$id.'\'')) > 0 ) {
        return true;
      }
      return false;
    }

}
