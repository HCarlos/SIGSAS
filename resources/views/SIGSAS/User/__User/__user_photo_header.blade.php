<!-- Personal-Information -->
@component('components.card-sin-fondo')
@slot('title_card', $user->username)
@slot('body_card')
    <div class="text-center">
    @if( $user->IsEmptyPhoto() )
        @if( $user->IsFemale() )
            <img src="{{ asset('images/web/empty_user_female.png')  }}" class="p-2px border-2 brc-primary-tp2 radius-round"/>
        @else
            <img src="{{ asset('images/web/empty_user_male.png')  }}" class="p-2px border-2 brc-primary-tp2 radius-round"/>
        @endif
    @else
        <a href="{{ route('quitarArchivoProfile/')  }}" class=" red " >
            <img src="{{Auth::user()->PathImageThumbProfile}}?timestamp={{now()}}" class="img-circle border border-white"  alt="{{$user->username}}"/>
            <i class="mdi mdi-delete-empty mdi-18px"></i>
        </a>
    @endif
    </div>
    <hr>
    <div class="card text-white bg-white" style="background-color: darkgray">
        <div class="card-body">
            <div class="toll-free-box  text-center" >
                <h4 class="text-dark-m3 text-140 text-truncate">
                    <i class="fa fa-user text-blue mr-2 w-2"></i>
                    {{ $items->FullName ?? '' }}
                </h4>

                <hr class="w-100 mx-auto mb-0 brc-default-l2">
                <div class="bg-gey radius-1 ">
                    <table class="table table table-striped-default table-borderless table-profile ">
                        <tbody>
                            <tr>
                                <td class="icon-profile"><i class="far fa-user text-success"></i></td>
                                <td class="field-profile text-95 text-600 text-secondary-d2 text-right">Username: </td>
                                <td class="value-profile text-dark-m3 text-left  text-truncate">{{ $items->username ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><i class="far fa-envelope text-blue"></i></td>
                                <td class="text-95 text-600 text-secondary-d2 text-right">Email: </td>
                                <td class="text-dark-m3 text-left text-truncate">{{ $items->email ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-phone text-danger"></i></td>
                                <td class="text-95 text-600 text-secondary-d2 text-right">Celular: </td>
                                <td class="text-dark-m3 text-left text-truncate">{{ $items->celulares ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><i class="far fa-file-alt text-purple"></i></td>
                                <td class="text-95 text-600 text-secondary-d2 text-right">CURP: </td>
                                <td class="text-dark-m3 text-left  text-truncate">{{ $items->curp ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-users text-orange"></i></td>
                                <td class="text-95 text-600 text-secondary-d2 text-right">Roles: </td>
                                <td class="text-dark-m3 text-left">
                                    @if( isset($items) )
                                        @foreach($items->roles as $role)
                                            <span class="ml-2">{{ $role->name }}</span>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-users-cog text-secondary"></i></td>
                                <td class="text-95 text-600 text-secondary-d2 text-right">Permisos: </td>
                                <td class="text-dark-m3 text-left">
                                    @if( isset($items) )
                                        @foreach($items->permissions as $permission)
                                            <span class="ml-2">{{ $permission->name }}</span>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-left pt-2">

                    <br>
                </div>

            </div>
        </div>
    </div>
@endslot
@endcomponent
