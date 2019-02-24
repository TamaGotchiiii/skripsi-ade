@extends('app-layouts.master-layout')
@section('content')
<?php
    $monthCount = [];
    $monthArr = [];

    $doneCount = [];
    $doneArr = [];

    $queueCount = [];
    $queueArr = [];

    $unitss = [];
    $unitName = [];

    $inProgressCount = [];
    $inProgressArr = [];

    foreach ($months as $key => $value) {
        $monthCount[(int) $key] = count($value);
    }

    $unitAll = $units->groupBy('id');

    foreach ($complainsDone as $key => $value) {
        $doneCount[(int) $key] = count($value);
    }

    foreach ($complainsQueue as $key => $value) {
        $queueCount[(int) $key] = count($value);
    }

    foreach ($complainsInProgress as $key => $value) {
        $inProgressCount[(int) $key] = count($value);
    }

    foreach ($units as $key => $value) {
        $unitss[(int) $key] = $value->name;
    }
    $count = 0;

    foreach ($unitAll as $key => $value) {
        ++$count;
        if (!empty($doneCount[(int) $key])) {
            $doneArr[$count] = $doneCount[(int) $key];
        } else {
            $doneArr[$count] = 0;
        }

        if (!empty($queueCount[(int) $key])) {
            $queueArr[$count] = $queueCount[(int) $key];
        } else {
            $queueArr[$count] = 0;
        }

        if (!empty($inProgressCount[(int) $key])) {
            $inProgressArr[$count] = $inProgressCount[(int) $key];
        } else {
            $inProgressArr[$count] = 0;
        }
        $unitName[$count] = $unitss[$count - 1];
    }

    for ($i = 1; $i <= 12; ++$i) {
        if (!empty($monthCount[$i])) {
            $monthArr[$i] = $monthCount[$i];
        } else {
            $monthArr[$i] = 0;
        }
    }

?>
<section class="content-header">
      <h1>
        Laporan Keluhan <span class="complain-year">{{$year}}</span>
      </h1>
    </section>

    <section class="content">
        <!-- info box -->
        <div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><b>Tabel Laporan Keluhan</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row ">
                    <div class="col-xs-1 pull-right">
                        <div class="form-group">
                            <div class="form-group">
                                <a href= "" class="btn btn-md btn-primary" id="filterBtn" style="display: inline-block;">Filter</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3 pull-right">
                        <div class="form-group">
                            <select name="" id="yearSelector" class="form-control">
                                <option value="{{$year}}">{{$year}}</option>
                                <?php $before = 0; ?>
                                @foreach($years as $yearr)
                                    @if($yearr->updated_at->format('Y') != $year && $yearr->updated_at->format('Y') != $before)
                                        <option value="{{$yearr->updated_at->format('Y')}}">{{$yearr->updated_at->format('Y')}}</option>
                                        <?php $before = $yearr->updated_at->format('Y'); ?>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12">
                    <canvas id="monthly-report" height="50"></canvas>
                </div>
                <div class="col-xs-12">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="col-xs-6 text-center">Fakultas/Unit</th>
                                <th  class="text-center">Keluhan belum ditangani</th>
                                <th  class="text-center">Keluhan dalam pengerjaan</th>
                                <th  class="text-center">Keluhan selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $done = 0;
                                $queue = 0;
                                $inProgress = 0;
                            ?>
                            @for($i = 1; $i<=$count; ++$i)
                                <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td>{{$unitName[$i]}}</td>
                                    <td class="text-center">{{$queueArr[$i]}}</td>
                                    <?php $queue += $queueArr[$i]; ?>
                                    <td class="text-center">{{$inProgressArr[$i]}}</td>
                                    <?php $inProgress += $inProgressArr[$i]; ?>
                                    <td class="text-center">{{$doneArr[$i]}}</td>
                                    <?php $done += $doneArr[$i]; ?>
                                </tr>
                            @endfor
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"><b>Total Keluhan belum ditangani</b></td>
                                <td class="text-center"><b>{{$queue}}</b></td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="3"><b>Total keluhan dalam pengerjaan</b></td>
                                <td class="text-center"><b>{{$inProgress}}</b></td>
                                <td colspan="1"></td>
                            </tr>
                            <tr>
                                <td colspan="4"><b>Total Keluhan Selesai Tahun {{$year}}</b></td>
                                <td class="text-center"><b>{{$done}}</b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            //click event
            $(document).on('click', '#filterBtn', function(e){
                e.preventDefault();
                let year = $('#yearSelector').val();
                window.location.href = "{{url('laporan-keluhan')}}" + "/" + year;
            });
            //bar chart
            let monthlyData = [];
            <?php foreach ($monthArr as $key => $val) {
                                ?>
                monthlyData.push('<?php echo $val; ?>');
            <?php
                            } ?>
            let monthlyReport = document.getElementById("monthly-report").getContext('2d');
            let monthlyChart = new Chart(monthlyReport, {
                type: 'bar',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets:[{
                        label:  'Laporan Keluhan',
                        data: monthlyData,
                        borderWidth: 1,
                        backgroundColor : [
                            "rgba(255, 0, 0, 0.5)", "rgba(0, 255, 0, 0.5)", "rgba(0, 0, 255, 0.5)", "rgba(128,0,128,0.5)", "rgba(139,0,139,0.5)", "rgba(255,140,0,0.5)", "rgba(72,209,204, 0.5)", "rgba(220,20,60, 0.5)", "rgba(255,20,147,0.5)", "rgba(255,255,0,0.5)", "rgba(124,252,0,0.5)", "rgba(75,0,130,0.5)"
                        ],
                        borderColor : [
                            "rgba(255, 0, 0, 1)", "rgba(0, 255, 0, 1)", "rgba(0, 0, 255, 1)", "rgba(128,0,128,1)", "rgba(139,0,139,1)","rgba(255,140,0,1)", "rgba(72,209,204, 1)", "rgba(220,20,60, 1)", "rgba(255,20,147,1)", "rgba(255,255,0,1)", 'rgba(124,252,0,1)', 'rgba(75,0,130,1)'
                        ],
                    }]
                },
                options: {
                    scales: {
                        yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endsection

