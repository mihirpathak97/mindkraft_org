<?php
  namespace App\Http\Controllers;
  use URL, DB;

  if (session()->has('userid') && Controller::checkUserId(session('userid'))) {
    $username = session('username');
  }
?>

<html lang="{{ app()->getLocale() }}">
  <head>
    @include('includes.meta')

    <title>MindKraft | Register</title>

    @include('includes.stylesheets')
  </head>

  <style media="screen">
    .container{
      margin-top: 10%;
    }
    .outer{
      width: 40%;
      display: block;
      padding-bottom: 3rem;
      margin: auto;
    }
    .terms{
      color: #f5f5f5;
      font-family: 'Raleway', sans-serif;
      font-size: 24px;
      text-align: center;
    }
    @media screen and (max-width: 769px){
      .outer{
        width: 95%;
      }
      .terms{
        font-size: 20px;
      }
    }
  </style>

  <body>

    <!-- Actual body -->

    <div id="base-hero">

      @include('includes.nav')

      @include('includes.mobilenav')

      <br><br><br>

      <h2 class="hero-head">Register</h2>

      <?php if (session()->has('username')): ?>

          <h2>A user is already logged in!</h2>

      <?php else: ?>

        <div class="outer">
          <p class="terms">
            By registering, you agree to the terms and conditions mentioned <a href="/terms" target="_blank">here.</a>
          </p>
        </div>

        <form class="" id="registerForm">
          <div class="field card">
            <label class="label">Full Name</label>
            <div class="control">
              <input class="input" type="text" name="name" placeholder="Your Name" required>
            </div>
            <p class="help"></p>
            <label class="label">Mobile Number</label>
            <div class="control">
              <input class="input" type="text" name="mobile" placeholder="Mobile number" required>
            </div>
            <p class="help"></p>
            <label class="label">E-Mail</label>
            <div class="control">
              <input class="input" type="text" name="email" placeholder="E-Mail ID" required>
            </div>
            <p class="help"></p>
            <label class="label">College Name</label>
            <div class="control">
              <!-- <input class="input" type="text" name="college" placeholder="College" required> -->
              <select class="" name="college">
                <option disabled selected> -- select an option -- </option>
                <option value="1">A.C. College of Engineering and Technology, Karaikudi</option>
                <option value="2">Aalim Muhammed Salegh College of Engineering, Chennai</option>
                <option value="3">Aarupadai Veedu Institute of Technology, Vinayaka Mission University, Chennai</option>
                <option value="4">ABES Engineering College , Ghaziabad</option>
                <option value="5">Acharya Institute of Technology, Bangalore</option>
                <option value="6">Acharya Nagarjuna University, Guntur</option>
                <option value="7">Acropolis Institute of Technology and Research, Indore</option>
                <option value="8">Adhi College of Engineering and Technology, Chennai</option>
                <option value="9">Adhiparasakthi college of engineering, Kancheepuram</option>
                <option value="10">Adhiyamaan College of Engineering, Hosur</option>
                <option value="11">Adi Shankara Institute of Engineering & Technology, Ernakulam</option>
                <option value="12">Adithya Institute of Technology, Coimbatore</option>
                <option value="13">Aditya College Of Engineering, Madanapalli</option>
                <option value="14">Aditya Institute of Management Studies and Research, Mumbai</option>
                <option value="15">Alagappa Chettiar College of Engineering and Technology, Karaikudi</option>
                <option value="16">Al-Ameen Engineering College, Erode</option>
                <option value="17">Al-Ameer College of Engineering and IT, Visakhapatnam</option>
                <option value="18">Alpha College of Engineering, Kurnool</option>
                <option value="19">Amrita Vishwa Vidyapeetham, Amritapuri, Kollam</option>
                <option value="20">Amrita Vishwa Vidyapeetham, Bengaluru</option>
                <option value="21">Amrita Vishwa Vidyapeetham, Coimbatore</option>
                <option value="22">Andhra University, Visakhapatnam</option>
                <option value="23">Anil Neerukonda Institute Of Technology and Science (ANITS), Visakhapatnam</option>
                <option value="24">Anna University - BIT Campus Tiruchirappall</option>
                <option value="25">Annamacharya Institute of Technology and Sciences, Tirupati</option>
                <option value="26">Apollo Priyadarshanam Institute of Technology, Chennai</option>
                <option value="27">Army Institute of Management and Technology, Noida</option>
                <option value="28">Arunai Engineering College, Tiruvannamalai</option>
                <option value="29">Avanthi Institute of Engineering and Technology, Visakhapatnam</option>
                <option value="30">B.S.Abdur Rahman University, Chennai</option>
                <option value="31">Bangalore Institute of Management Studies (BIMS)</option>
                <option value="32">Bannari Amman Institute of Technology, Sathyamangalam, Erode</option>
                <option value="33">Bapatla Engineering College, Andhra Pradesh</option>
                <option value="34">Bharat Institute of Engineering and Technology, Hyderabad</option>
                <option value="35">Bharath University, Chennai</option>
                <option value="36">Bharathidasan Institute of Management, Trichy</option>
                <option value="37">Bharathidasan University, Trichy</option>
                <option value="38">Bharathiyar College of Engineering and Technology, Puducherry</option>
                <option value="39">Bishop Heber College, Trichy</option>
                <option value="40">BITS Pilani Hyderabad Campus</option>
                <option value="41">BITS Pilani K.K. Birla Goa Campus</option>
                <option value="42">BMS Engineering College, Bangalore</option>
                <option value="43">BNM Institute of Technology, Bangalore</option>
                <option value="44">Brindavan Institute of Technology and Science, Kurnool</option>
                <option value="45">BSA Crescent Engineering College, Chennai</option>
                <option value="46">CARE College of Engineering, Trichy</option>
                <option value="47">CARE School of Engineering, Trichy</option>
                <option value="48">Chettinad College of Engineering and Technology, Karur</option>
                <option value="49">Christ College of Engineering and Technology, Puducherry</option>
                <option value="50">CMR Engineering College , Hyderabad</option>
                <option value="51">CMR Institute of Technology, Bangalore</option>
                <option value="52">Cochin University of Science and Technology (CUSAT)</option>
                <option value="53">Coimbatore Institute of Engineering and Technology (CIET)</option>
                <option value="54">Coimbatore Institute of Technology</option>
                <option value="55">College of Engineering and Technology, Bhubaneswar</option>
                <option value="56">College of Engineering, Guindy, Chennai</option>
                <option value="57">College of Engineering, Trivandrum</option>
                <option value="58">CSI College of Engineering, Ooty</option>
                <option value="59">CVSR College, Hyderabad</option>
                <option value="60">Dayanand Sagar College of Engineering, Bangalore</option>
                <option value="61">Dhanalakshmi Srinivasan College of Engineering and Technology, Chennai</option>
                <option value="62">Dhanalakshmi Srinivasan Engineering College, Trichy</option>
                <option value="63">Dhanalakshmi Srinivasan Institute of Technology, Trichy</option>
                <option value="64">Dhirajlal Gandhi College Of Technology, Salem</option>
                <option value="65">Dr. Mahalingam College of Engineering and Technology, Pollachi</option>
                <option value="66">Dr. N.G.P. Institute of Technology, Coimbatore</option>
                <option value="67">Easwari Engineering College, Chennai</option>
                <option value="68">EGS Pillay Engineering College, Nagapattinam</option>
                <option value="69">Engineering College, Barton hill, Trivandrum</option>
                <option value="70">Erode Builder Educational Trust's Group of Institution</option>
                <option value="71">Erode Sengunthar Engineering College, Thudupathi</option>
                <option value="72">Ethiraj College for Women, Chennai</option>
                <option value="73">Excel Engineering College, Namakkal</option>
                <option value="74">Federal Institute of Science and Technology (FISAT), Cochin</option>
                <option value="75">Francis Xavier Engineering College, Tirunelveli</option>
                <option value="76">G. Narayanamma Institute of Technology and Science, Hyderabad</option>
                <option value="77">G.Pulla Reddy Engineering College, Kurnool</option>
                <option value="78">Gayatri Vidya Parishad College Of Engineering, Visakhapatnam</option>
                <option value="79">Geethanjali Institute of Science and Technology, Nellore</option>
                <option value="80">Ghousia College of Engineering, Ramanagara</option>
                <option value="81">GITAM Institute of Technology, Hyderabad</option>
                <option value="82">GITAM Institute of Technology, Visakhapatnam</option>
                <option value="83">GITAM School of Technology, Bangalore</option>
                <option value="84">Gnanamani College of Technology, Namakkal</option>
                <option value="85">Government College of Engineering, Salem</option>
                <option value="86">Government College of Engineering, Srirangam</option>
                <option value="87">Government College of Engineering, Thanjavur</option>
                <option value="88">Government College of Engineering, Tirunelveli</option>
                <option value="89">Government College of Technology, Coimbatore</option>
                <option value="90">Government Engineering College, Calicut</option>
                <option value="91">Government Engineering College, Kannur</option>
                <option value="92">Government Engineering College, Thrissur</option>
                <option value="93">Government Engineering College, Trivandrum</option>
                <option value="94">Government Model Engineering College, Cochin</option>
                <option value="95">Gyan Ganga College of Technology, Jabalpur</option>
                <option value="96">Hindustan College of Engineering , Chennai</option>
                <option value="97">Hindusthan College of Engineering and Technology, Coimbatore</option>
                <option value="98">Hindusthan Institute of Technology, Coimbatore</option>
                <option value="99">Indian Institute of Information Technology Design and Manufacture, Kancheepuram</option>
                <option value="100">Indian Institute of Information Technology, Bhubaneswar</option>
                <option value="101">Indian Institute of Information Technology, Srirangam</option>
                <option value="102">Indian Institute of Information Technology, Trichy</option>
                <option value="103">Indian Institute of Management Bangalore</option>
                <option value="104">Indian Institute of Management, Trichy</option>
                <option value="105">Indian Institute of Science, Education and Research (IISER), Trivandrum</option>
                <option value="106">Indian Institute of Space Science and Technology, Trivandrum</option>
                <option value="107">Indian Institute of Technology, Chennai</option>
                <option value="108">Indian Institute of Technology, Palakkad</option>
                <option value="109">Indian Institute of Technology, Tirupati</option>
                <option value="110">Info Institute of Engineering, Coimbatore</option>
                <option value="111">Institute of Aeronautical Engineering, Hyderabad</option>
                <option value="112">Institute of Road and Transport Technology, Erode</option>
                <option value="113">International Institute of Information Technology, Bangalore</option>
                <option value="114">International Institute of Information Technology, Hyderabad</option>
                <option value="115">J J College of Engineering and Technology, Trichy</option>
                <option value="116">Jamal Mohamed College, Trichy</option>
                <option value="117">Jamna Lal Bajaj Institute of Management Studies, Mumbai</option>
                <option value="118">Jansons Institute of Technology, Coimbatore</option>
                <option value="119">Jawahar Engineering College, Chennai</option>
                <option value="120">Jawaharlal Nehru Technological University (JNTU), Anantapur</option>
                <option value="121">Jawaharlal Nehru Technological University (JNTU), Hyderabad</option>
                <option value="122">Jaya Engineering College, Chennai</option>
                <option value="123">Jayalakshmi Institute of Technology, Thoppur</option>
                <option value="124">Jayaraj Annapackiam CSI College of Engineering, Tuticorin</option>
                <option value="125">Jeppiaar Engineering College, Chennai</option>
                <option value="126">JNTU College of Engineering, Pulivendula</option>
                <option value="127">JNTUA College of Engineering, Kalikiri</option>
                <option value="128">JNTUK University College Of Engineering, Vizianagaram</option>
                <option value="129">K Ramakrishnan College of Technology, Trichy</option>
                <option value="130">K S Rangasamy College of Engineering, Tiruchengode</option>
                <option value="131">K S Rangasamy College of Technology, Tiruchengode</option>
                <option value="132">K. L. N College Of Engineering, Madurai</option>
                <option value="133">K. Ramakrishnan College of Engineering, Trichy</option>
                <option value="134">K. S. R Institute for Engineering and Technology, Tiruchengode</option>
                <option value="135">Kakatiya Institute of Technology and Science, Warangal</option>
                <option value="136">Kalaignar Karunanidhi Institute of Technology, Coimbatore</option>
                <option value="137">Kalasalingam Institute of Technology, Virudhunagar</option>
                <option value="138">Kalasalingam University, Virudhunagar</option>
                <option value="139">Kalinga Institute of Industrial Technology, Bhubaneswar</option>
                <option value="140">Kamaraj College of Engineering and Technology, Virudhunagar</option>
                <option value="141">Karpagam College of Engineering, Coimbatore</option>
                <option value="142">Karpagam Institute Of Technology, Coimbatore</option>
                <option value="144">Kathir College of Engineering, Coimbatore</option>
                <option value="145">KCG College of Technology, Chennai</option>
                <option value="146">KGISL Institute Of Technology, Coimbatore</option>
                <option value="147">Kings College of Engineering, Chennai</option>
                <option value="148">Kings College of Engineering, Pudukottai</option>
                <option value="149">KITS, Warangal</option>
                <option value="150">KLN College of Information Technology, Madurai</option>
                <option value="151">KMM Institute of Technology and Science, Tirupati</option>
                <option value="152">Knowledge Institute of Technology(KIOT), Salem</option>
                <option value="153">Kongu Engineering College, Erode</option>
                <option value="154">Kongunadu College of Engineering and Technology, Trichy</option>
                <option value="155">KPR Institute of Engineering and Technology, Coimbatore</option>
                <option value="156">Krishnasamy College of Engineering and Technology, Cuddalore</option>
                <option value="157">KS School of Engineering and Management, Bangalore</option>
                <option value="158">Kumaraguru College of Technology, Coimbatore</option>
                <option value="159">Latha Mathavan Engineering College, Madurai</option>
                <option value="160">LBS Institute of Technology for Women, Trivandrum</option>
                <option value="161">M.A.M College of Engineering & Technology, Trichy</option>
                <option value="162">M.A.M School of Engineering, Trichy</option>
                <option value="163">M.Kumarasamy College Of Engineering, Karur</option>
                <option value="164">M.S. Ramaiah Institute of Technology (MSRIT), Bangalore</option>
                <option value="165">Maamallan Institute of Technology, Sriperumbudur</option>
                <option value="166">Madanapalle Institute of Technology and Science (MITS) ,Chittoor</option>
                <option value="167">Madha Engineering College, Chennai</option>
                <option value="168">Madha Institute of Engineering and Technology, Chennai</option>
                <option value="169">Madras Institute of Technology (MIT), Anna University, Chennai</option>
                <option value="170">Madurai Kamaraj University (Arts & Science College)</option>
                <option value="171">Maharaj Vijayaram Gajapathi Raj (MVGR) College of Engineering, Vizianagaram</option>
                <option value="172">Mahath Amma Institute of Engineering & Technology, Pudukkottai</option>
                <option value="173">Mahatma Gandhi Institute of Technology (MGIT), Hyderabad</option>
                <option value="174">Mahendra Engineering College, Namakkal</option>
                <option value="175">Mahendra Institute of Technology, Namakkal</option>
                <option value="176">MAM College of Engineering, Trichy</option>
                <option value="177">Manipal Institute of Technology</option>
                <option value="178">Mar Athanasius College of Engineering, Kothamangalam</option>
                <option value="179">Mar Baselios College of Engineering and Technology,Thiruvananthapuram</option>
                <option value="180">Meenakshi Ramaswamy Engineering College, Ariyalur</option>
                <option value="181">Meenakshi Sundararajan Engineering college, Chennai</option>
                <option value="182">Mepco Schlenk Engineering College, Sivakasi</option>
                <option value="183">MIET Engineering College, Trichy</option>
                <option value="184">MNM Jain Engineering College, Chennai</option>
                <option value="185">Model Engineering College, Cochin</option>
                <option value="186">Mohamed Sathak Engineering College, Ramnathapuram</option>
                <option value="187">Mohandas college of Engineering and Technology,Trivandrum</option>
                <option value="188">Moogambigai College of Engineering, Trichy</option>
                <option value="189">Mookambigai College of Engineering, Pudukkottai</option>
                <option value="190">Motilal Nehru National Institute of Technology, Allahabad</option>
                <option value="191">Muthoot Institute of Technology and Science(MITS), Ernakulam</option>
                <option value="192">MVJ College of Engineering, Bangalore</option>
                <option value="193">MVSR Engineering College, Hyderabad</option>
                <option value="194">N.B.K.R.Institute of Science and Technology,Vidyanagar,Nellore</option>
                <option value="195">N.P.R College of Engineering and Technology, Dindigul</option>
                <option value="196">Nandha College of Technology Erode</option>
                <option value="197">Nandha Engineering College, Erode</option>
                <option value="198">Narasu's Sarathy Institute of Technology, Salem</option>
                <option value="199">Narayana Engineering College, Nellore</option>
                <option value="200">National Engineering college, Kovil Patti</option>
                <option value="201">National Institute of Engineering, Mysore</option>
                <option value="202">National Institute of Technology, Calicut</option>
                <option value="203">National Institute of Technology, Puducherry</option>
                <option value="204">National Institute of Technology, Silchar</option>
                <option value="205">National Institute of Technology, Surathkal, Karnataka</option>
                <option value="206">National Institute of Technology, Tiruchirappalli</option>
                <option value="207">National Institute of Technology, Warangal</option>
                <option value="208">NES Ratnam College of Arts, Science and Commerce, Mumbai</option>
                <option value="209">Nitte Meenakshi Institute of Technology, Bangalore</option>
                <option value="210">NMIMS, Bangalore</option>
                <option value="211">NPR College of Engineering & Technology (NPRCET), Dindigul</option>
                <option value="212">NSS College of Engineering, Palakkad</option>
                <option value="213">Osmania University, Hyderabad</option>
                <option value="214">Oxford Engineering College, Trichy</option>
                <option value="215">P. R. Engineering College (PREC), Thanjavur</option>
                <option value="216">P.M.R Engineering College, Chennai</option>
                <option value="217">P.T.R college of engineering and technology, Madurai</option>
                <option value="218">Paavai College of Technology, Namakkal</option>
                <option value="219">Paavai engineering College, Namakkal</option>
                <option value="220">Panimalar Engineering College, Chennai</option>
                <option value="221">Panimalar Institute of Technology, Chennai</option>
                <option value="222">Parisutham Institute of Technology and Science(PITS), Thanjavur</option>
                <option value="223">Periyar Maniammai University- School of Architecture, Engineering and Technology, Thanjavur</option>
                <option value="224">Perunthalaivar Kamarajar Institute of Engineering and Technology, Puducherry</option>
                <option value="225">PES - Main University, Bangalore</option>
                <option value="226">PES South Campus, Bangalore</option>
                <option value="227">Podhigai College of Engineering & Technology, Vellore</option>
                <option value="228">Pondicherry Engineering College</option>
                <option value="229">Pondicherry University</option>
                <option value="230">Prasad V Potluri (PVP) Siddhartha Institute of Technology, Vijayawada</option>
                <option value="231">Prathyusha Institute of Technology and Management, Thriuvallur</option>
                <option value="232">PRIST University, Thanjavur</option>
                <option value="233">PSG College of Arts and Science, Coimbatore</option>
                <option value="234">PSG College of Technology, Coimbatore</option>
                <option value="235">PSG Institute of Technology and Applied Research, Coimbatore</option>
                <option value="236">PSG Polytechnic College, Coimbatore</option>
                <option value="237">PSNA College of Engineering and Technology (PSNA CET), Dindigul</option>
                <option value="238">PSR Engineering College, Sivakasi</option>
                <option value="239">R V R & J C College of Engineering(Rayapati Venkata Rangarao & Jagarlamudi Chandramouli), Guntur</option>
                <option value="240">R.M.K. College of Engineering & Technology(RMKCET), Tiruvallur, Chennai</option>
                <option value="241">Rajagiri School of Engineering and Technology, Cocnhi</option>
                <option value="242">Rajalakshmi Engineering College , Chennai</option>
                <option value="243">Rajalakshmi Institute of Technology, Kancheepuram</option>
                <option value="244">Rajeev Gandhi Memorial College of Engineering and Technology, Kurnool</option>
                <option value="245">Rajiv Gandhi College of Engineering and Technology (RGCET), Puducherry</option>
                <option value="246">Rajiv Gandhi Institute of Technology, Kottayam</option>
                <option value="247">Ramco Institute of Technology, Chennai</option>
                <option value="248">Rashtreeya Vidyalaya College of Engineering (RV College of Engineering), Bangalore</option>
                <option value="249">RMD Engineering College, Chennai</option>
                <option value="250">RNS Institute of Technology, Bangalore</option>
                <option value="251">RRASE College of Engineering, Padapai, Chennai</option>
                <option value="252">RVS College of Engineering and Technology, Coimbatore</option>
                <option value="253">SACS MAVMM Engineering College, Madurai</option>
                <option value="254">Sahyadri College of Engineering and Management, Mangalore</option>
                <option value="255">Saranathan College of Engineering, Trichy</option>
                <option value="256">Sardar Vallabhbhai National Institute of Technology (SVNIT), Gujarat</option>
                <option value="257">SASTRA University(Shanmugha Arts, Science, Technology & Research Academy), Thanjavur</option>
                <option value="258">Sathyabama University/Sathyabama Institute of Science and Technology, Chennai</option>
                <option value="259">Saveetha Engineering College, Chennai</option>
                <option value="260">SBM College of Engineering and Technology, Dindigul</option>
                <option value="261">SCMS School Of Engineering And Technology, Cochin</option>
                <option value="262">Sengunthar College Of Engineering, Salem</option>
                <option value="263">Sethu Institute Of Technology, Virudhunagar</option>
                <option value="264">Shanmugha Polytechnic College, Thanjavur</option>
                <option value="265">Sheila Raheja School of Business Management and Research(SRBS), Mumbai</option>
                <option value="266">Shivani College of Engineering and Technology, Trichy</option>
                <option value="267">Shivani Engineering College, Trichy</option>
                <option value="268">SJB Institute of Technology, Bangalore</option>
                <option value="269">SKP Engineering College(SKPEC), Tiruvannamalai</option>
                <option value="270">SNS College of Technology, Coimbatore</option>
                <option value="271">Sona College of Technology, Salem</option>
                <option value="272">Sree Chitra Thirunal College of Engineering, Trivandrum</option>
                <option value="273">Sree Chitra Thirunal College of Engineering, Trivandrum</option>
                <option value="274">Sree Rama Engineering College, Tirupati</option>
                <option value="275">Sree Vidyanikethan Engineering College, Tirupati</option>
                <option value="276">Sri Eshwar College of Engineering, Coimbatore</option>
                <option value="277">Sri Krishna College of Engineering & Technology (SKCET), Coimbatore</option>
                <option value="278">Sri Krishna College Of Technology(SKCT), Coimbatore</option>
                <option value="279">Sri Manakula Vinayagar Engineering College, Puducherry</option>
                <option value="280">Sri Muthukumaran Institute Of Technology (SMIT), Chennai</option>
                <option value="281">Sri Muthukumaran Institute of technology, Chennai</option>
                <option value="282">Sri Ramakrishna Engineering College, Coimbatore</option>
                <option value="283">Sri Ramakrishna Institute of technology, Coimbatore</option>
                <option value="284">Sri Sairam Engineering College, Tambaram</option>
                <option value="285">Sri Shakthi Institute of Engineering and Technology, Coimbatore</option>
                <option value="286">Sri Sivasubramaniya Nadar College (SSN) of Engineering, Chennai</option>
                <option value="287">Sri Venkateshwara College of Engineering(SVCE), Chennai</option>
                <option value="288">Sri Venkateswara College of Engineering Technology, Chittoor</option>
                <option value="289">Sri Venkateswara University, Tirupati</option>
                <option value="290">Sriram Engineering College, Chennai</option>
                <option value="291">SRM University, Chennai</option>
                <option value="292">SSM College of Engineering, Namakkal</option>
                <option value="293">St Xaviers Catholic College of Engineering, Nagercoil</option>
                <option value="294">St. Joseph's College of Engineering and Technology, Palai</option>
                <option value="295">St. Joseph's College of Engineering and Technology, Thanjavur</option>
                <option value="296">St. Joseph's Institute of Technology, Chennai</option>
                <option value="297">St. Peter's Institute of Higher Education and Research, Thiruvallur</option>
                <option value="298">Syed Ammal Engineering college, Ramanathapuram</option>
                <option value="299">Symbiosis Institute of Technology, Pune</option>
                <option value="300">Tagore Engineering College, Chennai</option>
                <option value="301">Tamilnadu College of Engineering, Coimbatore</option>
                <option value="302">Thiagarajar College of Engineering, Madurai</option>
                <option value="303">Thiagarajar School of Management, Madurai</option>
                <option value="304">TKM College of Engineering, Kollam</option>
                <option value="305">Toc H Institute of Science And Technology, Cochin</option>
                <option value="306">TRP Engineering College, Trichy</option>
                <option value="307">Ultra College of Engineering and Technology for Women, Madurai</option>
                <option value="308">University College of Engineering Panruti</option>
                <option value="309">University College of Engineering, Thirukkuvalai, Nagapattinam</option>
                <option value="310">Vaghdevi College, Warangal</option>
                <option value="311">Vaigai college of engineering, Madurai</option>
                <option value="312">Valliammai Engineering College, Kanchipuram</option>
                <option value="313">Vasireddy Venkatadri Institute of Technology, Guntur</option>
                <option value="314">Vel Tech High Tech, Dr.Rangarajan Dr.Sakunthala Engineering College, Chennai</option>
                <option value="315">Vel Tech University, Chennai</option>
                <option value="316">Velagapudi Ramakrishna Siddhartha Engineering College, Vijayawada</option>
                <option value="317">Velalar College of Engineering and Technology, Erode</option>
                <option value="318">Velammal college of engineering and technology, Madurai</option>
                <option value="319">Velammal Engineering College, Chennai</option>
                <option value="320">Velammal Institute of Technology, Chennai</option>
                <option value="321">Vels Institute of Science, Technology & Advanced Studies, Pallavaram</option>
                <option value="322">Vetri Vinayaha College of Engineering and Technology, Trichy</option>
                <option value="323">Vickram College of Engineering, Madurai</option>
                <option value="324">Vidya Jyothi Institute of Technology, Hyderabad</option>
                <option value="325">Vidya Jyothi Institute of Technology, Hyderbad</option>
                <option value="326">Vignan University, Vadlamudi</option>
                <option value="327">Vignan's Institute Of Information Technology (VIIT), Visakhapatnam</option>
                <option value="328">Vimal Jyothi Engineering College, Kannur</option>
                <option value="329">Vinayaka Mission's Kirupananda Variyar Engineering College, Salem</option>
                <option value="330">Vishweswara College of Engineering, Bangalore</option>
                <option value="331">Visvesvaraya National Institute of Technology (VNIT), Nagpur</option>
                <option value="332">Visvodaya Engineering College, Nellore</option>
                <option value="333">Viswajyothi College of Engineering and Technology (VJCET), Cochin</option>
                <option value="334">VIT University, Chennai</option>
                <option value="335">VIT University, Vellore</option>
                <option value="336">VSA School of Engineering, Salem</option>
                <option value="337">VSA School of Management, Salem</option>
                <option value="338">VSB Engineering College, Karur</option>
                <option value="339">VV College of Engineering, Tirunelveli</option>
                <option value="340">Xavier Labour Relations Institute, Jamshedpur</option>
              </select>
            </div>
            <label class="label">College Name<br>(If not in list)</label>
            <div class="control">
              <input class="input" type="text" name="college_other">
            </div>
            <label class="label">State</label>
            <div class="control">
              <select class="" name="state" required>
                <option disabled selected value=""> -- select an option -- </option>
                <option value="1">Andra Pradesh</option>
                <option value="2">Arunachal Pradesh</option>
                <option value="3">Assam</option>
                <option value="4">Bihar</option>
                <option value="5">Chhattisgarh</option>
                <option value="6">Goa</option>
                <option value="7">Gujarat</option>
                <option value="8">Haryana</option>
                <option value="9">Himachal Pradesh</option>
                <option value="10">Jammu and Kashmir</option>
                <option value="11">Jharkhand</option>
                <option value="12">Karnataka</option>
                <option value="13">Kerala</option>
                <option value="14">Madya Pradesh</option>
                <option value="15">Maharashtra</option>
                <option value="16">Manipur</option>
                <option value="17">Meghalaya</option>
                <option value="18">Mizoram</option>
                <option value="19">Nagaland</option>
                <option value="20">Orissa</option>
                <option value="21">Punjab</option>
                <option value="22">Rajasthan</option>
                <option value="23">Sikkim</option>
                <option value="24">Tamil Nadu</option>
                <option value="25">Telangana</option>
                <option value="26">Tripura</option>
                <option value="27">Uttaranchal</option>
                <option value="28">Uttar Pradesh</option>
                <option value="29">West Bengal</option>
                <option value="30">Andaman and Nicobar Islands</option>
                <option value="31">Chandigarh</option>
                <option value="32">Dadra and Nagar Haveli</option>
                <option value="33">Daman and Diu</option>
                <option value="34">Lakshadweep</option>
                <option value="35">New Delhi</option>
                <option value="36">Puducherry</option>
              </select>
            </div>
            <label class="label">Password</label>
            <div class="control">
              <input class="input" type="password" name="password" placeholder="Password" required>
            </div>
            <p class="help"></p>
            <label class="label">Retype Password</label>
            <div class="control">
              <input class="input" type="password" name="retype" placeholder="Retype password" required>
            </div>
            <p class="help"></p>
            <div class="control">
              <br><br>
              <button class="button is-link">Register</button>
            </div>
            <p id="ajax-output"></p>
            <br><br>
          </div>
        </form>

      <?php endif; ?>

    </div>

  </body>
  @include('includes.jsmin')

</html>
