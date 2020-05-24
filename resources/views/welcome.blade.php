@extends('layout.master')

@section('title','Dashboard')
@section('content')
<div class="row pt-2">  
</div>
<hr>

<div class="card card-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-cyan">
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
      </div>
      <!-- /.widget-user-image -->
      <h3 class="widget-user-username">I Putu Adi Merta Pratama</h3>
      <h5 class="widget-user-desc">1705551072</h5>
    </div>
  </div>
  
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"> Jumlah Kasus Tanggal {{$tanggalSekarang}}</h3>
          </div>
        </div>
      </div>
    
  
<!-- Small boxes (Stat box) -->
  <div class="row mt-1">

    <!-- BoX Positif -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Jumlah Positif</span>
            <div class="inner">
              <h3>{{$totalPositif[0]->positif}} <sup style="font-size: 20px" ></sup></h3>
            </div>
          </div>  
      </div>
    </div>

    <!-- BoX Sembuh -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Jumlah Sembuh</span>
            <div class="inner">
            <h3>{{$totalSembuh[0]->sembuh}} <sup style="font-size: 20px"></sup></h3>
            </div>
          </div>  
      </div>
    </div>

    <!-- BoX Di Rawat -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Jumlah Dirawat</span>
            <div class="inner">
            <h3>{{$totalDirawat[0]->dirawat}} <sup style="font-size: 20px"></sup></h3>
            </div>
          </div>  
      </div>
    </div>

    <!-- BoX Meninggal -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Jumlah Meninggal</span>
              <div class="inner">
              <h3>{{$totalMeninggal[0]->meninggal}} <sup style="font-size: 20px"></sup></h3>
              </div>
            </div>  
        </div>
      </div>


  <!-- FILTER TANGGAL -->
  <div class="col-7">
  <div class="card-body">
    <h5 class="card-title">Filter Data Berdasar Tanggal</h5>
    <form action="/search" method="POST">
    @csrf
    <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
        <input id="tanggalSearch" type="date" @if(isset($tanggal)) value="{{$tanggal}}" @endif name="tanggal"
          class="form-control" required>
        <span class="input-group-btn">
          <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-search"></i></button>  
      </form></div> </div>

      <div class="alert alert-info"> 
      <p><i class="fa fa-info-circle text-white"></i> Silahkan melakukan pencarian berdasarkan tanggal untuk melihat data kasus pada tanggal tertentu, Data kasus
      ditampilkan dalam bentuk tabel perkabupaten serta Map Geografis Provinsi Bali.</p>
     </div>
      
<!-- PETA -->
  <div class="col-16">

    <div class="card card-gray">
      <div class="card-header">
        <h3 class="card-title">Peta Penyebaran Covid Provinsi Bali <strong>{{$tanggalSekarang}}</strong></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body no-padding p-0">
        <div class="row">
          <div class="col-12">
            <div class="pad">
              <div id="mapid" style="height: 500px"></div>
            </div>
          </div>
        </div>

      </div>
      <!-- /.card-body -->
      <div class="card-footer" style="background: white">
        <div class="row">
          <div class="col-6">
            <p>Color Start:</p>
            <input type="color" value="#E5310A" class="form-control" id="colorStart">
          </div>
          <div class="col-6">
            <p>Color End:</p>
            <input type="color" value="#E8DEDB" class="form-control" id="colorEnd">
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-12">
            <button class="btn btn-primary form-control" id="btnGenerateColor">Generate Color</button>
          </div>

        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>

<!-- TABEL -->
  <div class="col-5">
    <div class="card card-gray">
      <div class="card-header">
        <h3 class="card-title">Data Sebaran Covid-19 Provinsi Bali <strong>{{$tanggalSekarang}}</strong></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>             
              <th>Kabupaten</th>
              <th>Positif</th>
              <th>Meninggal</th>
              <th>Sembuh</th>
              <th>Dirawat</th>
              {{-- <th>Tanggal</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr>
              <td>{{ucfirst($item->kabupaten)}}</td>
              <td>{{$item->positif}}</td>
              <td>{{$item->meninggal}}</td>
              <td>{{$item->sembuh}}</td>
              <td>{{$item->dirawat}}</td>
              {{-- <td>{{$item->tanggal}}</td> --}}
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>

@endsection
@section("js")
<script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
<script src="https://pendataan.baliprov.go.id/assets/frontend/map/leaflet.markercluster-src.js"></script>
<script src="http://leaflet.github.io/Leaflet.label/leaflet.label.js" charset="utf-8"></script>
<script>
  $(document).ready(function () {
    var dataMap=null;
    var dataColor=null;
    var colorMap=[
      "edff6b",
      "dcec5d",
      "ccd950",
      "bcc743",
      "acb436",
      "9ba128",
      "8b8f1b",
      "7b7c0e",
      "6b6a01"
    ];
    var tanggal = $('#tanggalSearch').val();
    $.ajax({
      async:false,
      url:'getDataMap',
      type:'get',
      dataType:'json',
      data:{date: tanggal},
      success: function(response){
        dataMap = response["dataMap"];
        dataColor = response["dataColor"];
      }
    });
    console.log(dataMap);
    console.log(dataColor);
    var map = L.map('mapid',{
      fullscreenControl:true,
    });
    
    $('#btnGenerateColor').on('click',function(e){
      var colorStart = $('#colorStart').val();
      var colorEnd = $('#colorEnd').val();
      $.ajax({
        async:false,
        url:'/create-pallete',
        type:'get',
        dataType:'json',
        data:{start: colorStart, end:colorEnd},
        success: function(response){
          colorMap = response;
          setMapColor();
          
        }
      });
      
    });
    
    
    map.setView(new L.LatLng(-8.500410, 115.195839),10);
    var OpenTopoMap = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 20,
            // zoomAnimation:true,
            id: 'mapbox/streets-v11',
            // tileSize: 512,
            // zoomOffset: -1,
            accessToken: 'pk.eyJ1Ijoid2lkaWFuYXB3IiwiYSI6ImNrNm95c2pydjFnbWczbHBibGNtMDNoZzMifQ.kHoE5-gMwNgEDCrJQ3fqkQ',
        }).addTo(map);
    OpenTopoMap.addTo(map);
    var defStyle = {opacity:'1',color:'#000000',fillOpacity:'0',fillColor:'#CCCCCC'};
    setMapColor();
    // var m = L.marker([-8.500410, 115.195839]).bindLabel('A sweet static label!', { noHide: true })
		// 	.addTo(map)
		// 	.showLabel();

    function setMapColor(){
      var markerIcon = L.icon({
        iconUrl: '/img/marker.png',
        iconSize: [40, 40],
      });
      var BADUNG,BULELENG,BANGLI,DENPASAR,GIANYAR,JEMBRANA,KARANGASEM,KLUNGKUNG,TABANAN;
      dataColor.forEach(function(value,index){
        var colorKab = dataColor[index].kabupaten.toUpperCase();
        if(colorKab == "BADUNG"){
          BADUNG = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab=="BULELENG"){
          BULELENG = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        } else if(colorKab=="BANGLI"){
          BANGLI = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab=="DENPASAR"){
          DENPASAR = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab=="GIANYAR"){
          GIANYAR = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab =="JEMBRANA"){
          JEMBRANA = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab=="KARANGASEM"){
          KARANGASEM = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab=="TABANAN"){
          TABANAN = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }else if(colorKab =="KLUNGKUNG"){
          KLUNGKUNG = {opacity:'1',color:'#000',fillOpacity:'1',fillColor: '#'+colorMap[index]};
        }

      });
      var kmzParser = new L.KMZParser({
          onKMZLoaded: function (kmz_layer, name) {
              control.addOverlay(kmz_layer, name);
              var markers = L.markerClusterGroup();
              var layers = kmz_layer.getLayers()[0].getLayers();
              layers.forEach(function(layer, index){
                var kab  = layer.feature.properties.NAME_2;
                console.log(kab);
                kab = kab.toUpperCase();
                var kabLower = kab.toLowerCase();
                var data;
                if(!Array.isArray(dataMap) || !dataMap.length == 0){
                // set sub layer default style positif covid
                  // var STYLE = {opacity:'1',color:'#000',fillOpacity:'1',fillColor:'#'+colorMap[index]}; 
                  // layer.setStyle(STYLE);
                  if(kab == 'BADUNG'){
                    layer.setStyle(BADUNG);
                  }else if(kab == 'BANGLI'){
                    layer.setStyle(BANGLI);
                  }else if(kab == 'BULELENG'){
                    layer.setStyle(BULELENG);
                  }else if(kab == 'DENPASAR'){
                    layer.setStyle(DENPASAR);
                  }else if(kab == 'GIANYAR'){
                    layer.setStyle(GIANYAR);
                  }else if(kab == 'JEMBRANA'){
                    layer.setStyle(JEMBRANA);
                  }else if(kab == 'KARANGASEM'){
                    layer.setStyle(KARANGASEM);
                  }else if(kab == 'KLUNGKUNG'){
                    layer.setStyle(KLUNGKUNG);
                  }else if(kab == 'TABANAN'){
                    layer.setStyle(TABANAN);
                  } 
                    data = '<table width="300">';
                    data +='  <tr>';
                    data +='    <th colspan="2">Keterangan</th>';
                    data +='  </tr>';
                  
                    data +='  <tr>';
                    data +='    <td>Kabupaten</td>';
                    data +='    <td>: '+kab+'</td>';
                    data +='  </tr>';              
    
                    data +='  <tr style="color:red">';
                    data +='    <td>Positif</td>';
                    data +='    <td>: '+dataMap[index].positif+'</td>';
                    data +='  </tr>';

                    data +='  <tr style="color:green">';
                    data +='    <td>Sembuh</td>';
                    data +='    <td>: '+dataMap[index].sembuh+'</td>';
                    data +='  </tr>'; 

                    data +='  <tr style="color:black">';
                    data +='    <td>Meninggal</td>';
                    data +='    <td>: '+dataMap[index].meninggal+'</td>';
                    data +='  </tr>';

                    data +='  <tr style="color:blue">';
                    data +='    <td>Dalam Perawatan</td>';
                    data +='    <td>: '+dataMap[index].dirawat+'</td>';
                    data +='  </tr>';               
                                  
                    data +='</table>';
                    if(kab == 'BANGLI'){
                      markers.addLayer( 
                        L.marker([-8.254251, 115.366936] ,{
                          icon: markerIcon
                        }).bindPopup(data).addTo(map)
                      );
                    }
                    else if(kab == 'GIANYAR'){
                      markers.addLayer( 
                        L.marker([-8.422739, 115.255700] ,{
                          icon: markerIcon
                        }).bindPopup(data).addTo(map)
                      );

                    }else if(kab == 'KLUNGKUNG'){
                      markers.addLayer( 
                        L.marker([-8.487338, 115.380029] ,{
                          icon: markerIcon
                        }).bindPopup(data).addTo(map)
                      );

                    }else{
                      markers.addLayer( 
                        L.marker(layer.getBounds().getCenter(),{
                          icon: markerIcon
                        }).bindPopup(data).addTo(map)
                      );
                    }
                }else{
                  var data = "Tidak ada Data pada tanggal tersebut"
                  layer.setStyle(defStyle);
                }
                layer.bindPopup(data);
                
              });
              map.addLayer(markers);
              kmz_layer.addTo(map);
          }
      });
      kmzParser.load('bali-kabupaten.kmz');
      var control = L.control.layers(null, null, {
          collapsed: true
      }).addTo(map);
      $('.leaflet-control-layers').hide();

    }
  });
</script>
@endsection