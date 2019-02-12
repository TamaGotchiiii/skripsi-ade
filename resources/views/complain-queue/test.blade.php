<tbody>
                <?php $x = 1; ?>
                @foreach($complains as $complain)
                <div class="data">
                <tr>
                  <td >{{$x}}</td>
                  <td>{{$complain->name}}</td>
                  <td>{{$complain->unit->name}}</td>
                  <td>{{str_limit($complain->description, $limit = 100, $end = '...')}}</td>
                  <td>{{$complain->complain_type->title}}</td>
                  <td>{{$complain->created_at->format('d M Y')}}</td> 
                    <!-- Operator And Supervisor -->
                    @if($complain->status == 0)
                      <td style="vertical-align: middle;"><i class="dot-queue"></i> Dalam Antrian</td>
                      @if(Auth::user()->level_user == 1)
                        <td>Belum Ditangani</td>
                      @endif
                    @elseif($complain->status == 1)
                      <td style="vertical-align: middle;"><i class="dot-progress"></i> Sedang Dikerjakan</td>
                      @if(Auth::user()->level_user == 1)
                        <td>{{$complain->user->name}}</td>
                      @endif
                    @else
                      <td style="vertical-align: middle;"><i class="dot-done"></i> Selesai, {{$complain->updated_at->format('d M Y')}}</td>
                      @if(Auth::user()->level_user == 1)
                        <td>{{$complain->user->name}}</td>
                      @endif
                    @endif
                  @if(Auth::user()->level_user != 1)
                    <td style="vertical-align: middle;" class="text-center">
                      <div class="btn-group">
                        @if(Auth::user()->level_user == 0 && $complain->status == 0)
                          <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#takeModal{{$complain->id}}" title="Tangani Keluhan" ><i class="fa fa-sign-in"></i></button>
                        @endif
                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#viewModal{{$complain->id}}"><i class="fa fa-eye" title="Lihat Detail Keluhan"></i></button>
                        @if($complain->status == 0 || $complain->status == 1)
                          @if($complain->status == 1)
                            <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#confirmEditModal"><i class="fa fa-pencil" title="Ubah Data Keluhan"></i></button>
                          @else
                          <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editModal{{$complain->id}}"><i class="fa fa-pencil" title="Ubah Data Keluhan"></i></button>
                          @endif
                          <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteModal{{$complain->id}}"><i class="fa fa-trash" title="Hapus Data Keluhan"></i></button>
                        @endif
                      </div>
                    </td>
                  @endif
                </tr>
                </div>
                <?php ++$x; ?>
                @endforeach
                </tbody>