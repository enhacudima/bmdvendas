@foreach($sub_ficha as $ficha)
    <div class="display-comment" @if($ficha->parent_id != null) style="margin-left:40px;" @endif>

        <!-- /.box-body -->
        <div class="box-footer box-comments">
        
            <div class="box-comment">
            <!-- User image -->
            <img class="img-circle img-sm" src="{{asset('storage/'.$ficha->user->avatar)}}" alt="User Image">

            <div class="comment-text">
                    <span class="username">
                    {{$ficha->user->name}}  
                    <span class="text-muted pull-right">{{$ficha->updated_at->diffForHumans()}} - {{$ficha->updated_at->format('d/M/Y')}}</span>
                    </span><!-- /.username -->
                    <tr>
                    <td>
                        <p >
                            <div class="media">
                                <div >
                                    <div class="media-body" style="margin-left: 10px">
                                        @if(isset($ficha->anamnese))Anamnese <br>@endif
                                        @if((isset($ficha->sinais_clinicos)))Sinais Clinicos <br>@endif
                                        @if((isset($ficha->exame)))Exames <br>@endif
                                        @if((isset($ficha->diagnostico)))Diagnostico <br>@endif
                                        @if((isset($ficha->observacao)))Observação <br>@endif
                                        @if((isset($ficha->peso)))Peso <br>@endif

                                        @if($ficha->status=="0")
                                        <span style="color: #25b347">
                                            Aberto
                                        </span>
                                        @else
                                        @if($ficha->status=="1")
                                        <span style="color: #25b347">
                                            Internamento
                                        </span>
                                        @else
                                        @if($ficha->status=="2")
                                        <span style="color: #ef1908">
                                            <label class="control-label" style="color: #00a65a"><i class="fa fa-check"></i> <i> Alta</i></label>
                                        </span>
                                        @else
                                        @if($ficha->status=="3")
                                        <span style="color: #ef1908">
                                            Óbto
                                        </span>
                                        @endif
                                        @endif
                                        @endif
                                        @endif
                                    </div>
                                    
                                </div>
                                <i><small><a href="{{route('ficha-clinica.show',$ficha->id)}}">Clique aqui para ver com mais detalhes...</a></small></i>
                            </div>
                        </p>
                    </td>
                </tr>
            </div>

            <!-- /.comment-text -->
            </div>
                
           
            <a  class="btn btn-link btn-xs" href="{{url('ficha-clinica/seguimento',$ficha->id)}}"> <span class="fa fa-plus "></span> Consulta de Seguimento</butaton>
                
        </div>

        <a href="" id="reply"></a> 
        @include('admin.ficha_clinica.parent', ['sub_ficha' => $ficha->subFicha])      
    </div>
@endforeach


