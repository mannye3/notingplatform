 <?php foreach($data['Close_Deal'] as $Close_Deal) :
         
          $usi = $Close_Deal->Close_Price;
          $date = $Close_Deal->Close_Date;
           $date = strtotime($date);
            $date *= 1000;      
             $data1[] = "[$date , $usi]";
  ?>
          
         <?php endforeach; ?> 




         <?php foreach($data['Deals'] as $Deals) :

          $Vol = $Deals->Daily_Volume;
          $datedeals = $Deals->Volume_Date;
          $datedeals = strtotime($datedeals);
            $datedeals *= 1000;

             $datadeals[] = "[$datedeals , $Vol]";

        


  ?>
               
               
         <?php endforeach; ?> 
  






 <!-- Start Breadcrumbbar -->                    
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">Home</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                               
                            </ol>
                        </div>
                    </div>
                   <!--  <div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>
                        </div>                        
                    </div> -->
                </div>          
            </div>

            <ul>
           
        </ul>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar -->    
            <div class="contentbar">                
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    
                    <!-- End col -->                    
                    <!-- Start col -->
                    <div class="col-lg-12 col-xl-12">
                        <div class="card m-b-30 dash-widget">
                            <div class="card-header">                                
                                <div class="row align-items-center">
                                    
                                    <div class="col-7">
                                     
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-0 pl-0 pr-2">
                               <div id="container" style="height: 500px; min-width: 300px"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
                <!-- Start row -->
               
                <!-- End row -->
            </div>







    <script type="text/javascript">
        
        Highcharts.getJSON('https://cdn.rawgit.com/highcharts/highcharts/057b672172ccc6c08fe7dbb27fc17ebca3f5b770/samples/data/aapl-ohlcv.json', function (data) {

  // split the data set into ohlc and volume
  var ohlc = [],
    volume = [],
    dataLength = data.length,
    // set the allowed units for data grouping
    groupingUnits = [[
      'week',             // unit name
      [1]               // allowed multiples
    ], [
      'month',
      [1, 2, 3, 4, 6]
    ]],

    i = 0;

  for (i; i < dataLength; i += 1) {
    ohlc.push([
      data[i][0], // the date
      data[i][1], // open
      data[i][2], // high
      data[i][3], // low
      data[i][4] // close
    ]);

    volume.push([
      data[i][0], // the date
      data[i][5] // the volume
    ]);
  }


  // create the chart
  Highcharts.stockChart('container', {

    rangeSelector: {
      selected: 1
    },

    title: {
      text: ''
    },

    yAxis: [{
      labels: {
        align: 'right',
        x: -3
      },
      title: {
        text: 'OHLC'
      },
      height: '60%',
      lineWidth: 2,
      resize: {
        enabled: true
      }
    }, {
      labels: {
        align: 'right',
        x: -3
      },
      title: {
        text: 'Volume'
      },
      top: '65%',
      height: '35%',
      offset: 0,
      lineWidth: 2
    }],

    tooltip: {
      split: true
    },

    series: [{
      type: '',
      name: 'PRICE',
       data: [<?php echo join($data1, ',') ?>],
      
      
      dataGrouping: {
        units: groupingUnits
      }
    }, {
      type: 'column',
      name: 'Volume',
       data: [<?php echo join($datadeals, ',') ?>],
     
      yAxis: 1,
      dataGrouping: {
        units: groupingUnits
      }
    }]
  });
});
    </script>
 