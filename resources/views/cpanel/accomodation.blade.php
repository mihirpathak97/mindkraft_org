<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect, Request;

  if (!session()->has('cpaneluser') || !Controller::checkAdmin(session('cpaneluser'))) {
    Redirect::to('cpanel')->send();
  }

  $request = new Request();

  $prefix = env('DB_TABLE_PREFIX', '');
  $user = DB::select('select * from '.$prefix.'enduser where mobile=\''.Request::input('mobile').'\'');

  if (count($user) == 0) {
    echo "User Not Found!";
    return;
  }

  $user = $user[0];

  $access_level = CpanelController::getAccessLevel(session('cpaneluser'));


  function checkUserStatus($id)
  {
    if (count(DB::select('select * from mindkraft18_approved_enduser where id=\''.$id.'\'')) > 0 ) {
      return true;
    }
    return false;
  }

?>

<!DOCTYPE html>
<html>
  <head>
    @include('admin.includes.meta')
    <title>Admin Console</title>
    @include('admin.includes.stylesheets')
  </head>
  <style media="screen">
    .card{
      margin: auto;
      margin-top: 2rem;
    }
  </style>
  <body>
    <section class="hero is-primary">

     <div class="hero-body" style="background:#383838">
       <div class="container">
         <div class="columns is-vcentered">
           <div class="column">
             <p class="title">
               -$ DevConsole
             </p>
           </div>
         </div>
       </div>
     </div>

     <div class="hero-foot">
       <div class="container">
         <nav class="tabs is-boxed">
           <ul>
             <li class="is-active">
               <a href="/cpanel/console" id='active'>Admin Console</a>
             </li>
           </ul>
         </nav></div>
       </div>

   </section>
    <div id="app">

      <nav class="navbar has-shadow">
        <div class="container">
          <div class="navbar-brand">
            <a class="navbar-item is-tab" href="/cpanel/console">Dashboard</a>
            <a class="navbar-item is-tab is-active">Acoomodation</a>
          </div>
        </div>
      </nav>

      <?php if ($access_level == 11): ?>
        <div class="box">
          <p><b>Name</b> - <?php echo $user->name ?></p>
          <p><b>College</b> - <?php echo $user->college ?></p>
          <p><b>Registration Number</b> - <?php echo $user->register_number ?></p><br>

          <p class="ip-group">
          <label class="label">From Date</label>
          <div class="control">
            <div class="select">
              <select id="from" class="select" name="from">
                <option disabled selected> -- select an option -- </option>
                <option value="15">15-03-2018</option>
                <option value="16">16-03-2018</option>
              </select>
            </div>
          </div>
          </p>

          <p class="ip-group">
          <label class="label">To Date</label>
          <div class="control">
            <div class="select">
              <select id="to" class="select" name="to">
                <option disabled selected> -- select an option -- </option>
                <option value="16">16-03-2018</option>
                <option value="17">17-03-2018</option>
                <option value="18">18-03-2018</option>
              </select>
            </div>
          </div>
          </p>

          <p class="ip-group">
            <label class="checkbox">
              <input type="checkbox">
              Food Required
            </label>
          </p>

          <br>
          <p><b>Per Day</b> - Rs. <span id="per">250</span></p><br>
          <p><b>Total</b> - Rs. <span id="total">0</span></p>

          <?php // NOTE: Confirm wether to provide accomodation for unapproved user ?>
          <?php if (!checkUserStatus($user->id)): ?>
            <br><b>Note</b> - User is not approved!<br>
          <?php endif; ?>
            <b>Total Amount To Be Payed </b> - Rs. 200<br><br>
            <button type="button" id="button" class="button is-link" name="button">Make Payment</button>
          <br><br>
          <p id="ajax-output"></p>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">

        // Update Per Day Charges
        $('input[type="checkbox"]').change(function () {
          console.log('changed');
          if (this.checked) {
            $('#per').text('400');
          }
          else {
            $('#per').text('250');
          }
        });

        function checkValidity() {
          if ($('#from').val() != null && $('#to').val() != null) {
            return true;
          }
          return false;
        }

        function getTotal() {
          return (parseInt($('#to').val()) - parseInt($('#from').val())) * parseInt($('#per').text());
        }

        $('select').on('change', function () {
          if (checkValidity()) {
            $('#total').text(getTotal());
          }
        });

        $('#button').click(function () {

          if (!checkValidity()) {
            alert('Please enter a valid date!');
            return false;
          }

          message = '0';
          if ($('.checkbox').checked) {
            message = '1';
          }

          console.log({'from': $('#from').val(), 'to': $('#to').val(), 'total': $('#total').text(), 'food': message});

          $.ajax({
            type: 'POST',
            url: '/cpanel/user/<?php echo $user->id ?>/accomodation',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'from': $('#from').val(), 'to': $('#to').val(), 'total': $('#total').val(), 'food': message},
            success: function (data) {

              console.log(data);
              data = JSON.parse(data);

              var payed = {};

              function numberToEnglish( n ) {

                var string = n.toString(), units, tens, scales, start, end, chunks, chunksLen, chunk, ints, i, word, words, and = 'and';

                /* Is number zero? */
                if( parseInt( string ) === 0 ) {
                    return 'zero';
                }

                /* Array of units as words */
                units = [ '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen' ];

                /* Array of tens as words */
                tens = [ '', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety' ];

                /* Array of scales as words */
                scales = [ '', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion', 'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quatttuor-decillion', 'quindecillion', 'sexdecillion', 'septen-decillion', 'octodecillion', 'novemdecillion', 'vigintillion', 'centillion' ];

                /* Split user arguemnt into 3 digit chunks from right to left */
                start = string.length;
                chunks = [];
                while( start > 0 ) {
                    end = start;
                    chunks.push( string.slice( ( start = Math.max( 0, start - 3 ) ), end ) );
                }

                /* Check if function has enough scale words to be able to stringify the user argument */
                chunksLen = chunks.length;
                if( chunksLen > scales.length ) {
                    return '';
                }

                /* Stringify each integer in each chunk */
                words = [];
                for( i = 0; i < chunksLen; i++ ) {

                    chunk = parseInt( chunks[i] );

                    if( chunk ) {

                        /* Split chunk into array of individual integers */
                        ints = chunks[i].split( '' ).reverse().map( parseFloat );

                        /* If tens integer is 1, i.e. 10, then add 10 to units integer */
                        if( ints[1] === 1 ) {
                            ints[0] += 10;
                        }

                        /* Add scale word if chunk is not zero and array item exists */
                        if( ( word = scales[i] ) ) {
                            words.push( word );
                        }

                        /* Add unit word if array item exists */
                        if( ( word = units[ ints[0] ] ) ) {
                            words.push( word );
                        }

                        /* Add tens word if array item exists */
                        if( ( word = tens[ ints[1] ] ) ) {
                            words.push( word );
                        }

                        /* Add 'and' string after units or tens integer if: */
                        if( ints[0] || ints[1] ) {

                            /* Chunk has a hundreds integer or chunk is the first of multiple chunks */
                            if( ints[2] || ! i && chunksLen ) {
                                words.push( and );
                            }

                        }

                        /* Add hundreds word if array item exists */
                        if( ( word = units[ ints[2] ] ) ) {
                            words.push( word + ' hundred' );
                        }

                    }

                }

                return words.reverse().join( ' ' );

              }

              Object.keys(data.for).forEach(function(key) {
                console.log(key + '-' + data.for[key]);
                payed[key] = data.for[key];
              });

              function getExtraMessage() {
                days = parseInt($('#to').val()) - parseInt($('#from').val());
                acc = ' - ' + days + ' day(s)';
                if (message == 'yes') {
                  acc += ' with food';
                }
                return acc;
              }

              printWindow = window.open('', 'PRINT', 'height=400, width=600');
              printWindow.document.write('<html><head><title>MindKraft Registrtion Invoice</title><br>');
              printWindow.document.write('<img src="https://mindkraft.org/images/mk-cropped.png" width="40px" height="40px" style="float:left; margin-left:170px; margin-right:10px; margin-top:15px">');
              printWindow.document.write('<h2>MindKraft 2018</h2>');
              printWindow.document.write('<b>Name: </b> - <?php echo $user->name ?><br>');
              printWindow.document.write('<b>User ID: </b> - MK-'+ data.user +'<br>');
              printWindow.document.write('<b>Receipt Number: </b> - ' + data.receipt + '<br>');
              var total = 0;
              Object.keys(payed).forEach(function(key) {
                total = total + parseInt(payed[key]);
              });
              printWindow.document.write('<br>Recieved with thanks a sum of <b>₹ '+total+'</b> towards - <br>');
              printWindow.document.write('<br><b>Total in Words</b>' + '<span style="margin-left: 30px"> RUPEES '+numberToEnglish(total).toUpperCase()+' ONLY</span>' + '<br><br>');
              Object.keys(payed).forEach(function(key) {
                printWindow.document.write(key.charAt(0).toUpperCase() + key.substr(1) + getExtraMessage() + '<span style="float:right">₹ '+payed[key]+'</span>' + '<br>');
              });
              printWindow.document.write('<br><br><b>Cashier</b>' + '<span style="float:right"><b>Organizing Secretary<br>MindKraft 2018</b></span>')
              printWindow.document.close(); // necessary for IE >= 10
              printWindow.focus(); // necessary for IE >= 10*/
              printWindow.print();
              printWindow.close();

            }
          });
        });
        </script>

        <br><br>

        <?php else: ?>
        <div class="box">
          <b>401 - Unauthorized Access!</b>
        </div>
      <?php endif; ?>

    </div>
  </body>
</html>
