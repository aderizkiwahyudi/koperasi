<x-app-layout>
    
    <main id="dashboard">
        
        <x-app-header-layout></x-app-header-layout>
        
        <div class="content">
            <div class="row">
                <div class="col col-item col-md-6">

                    <x-alert></x-alert>

                    <div class="item bg-white p-3 rounded border">
                        <form method="post">
                            @csrf
                            <div class="item-header">
                                <h5>PENGATURAN AKUN</h5>
                            </div>
                            <div class="item-body">
                                <div class="form-group mb-2">
                                    <label for="" class="label"><small>Nama</small></label>
                                    <input type="text" name="name" class="form-control" placeholder="Masukan nama anda" value="{{ auth('user')->user()->name ?? '' }}"/>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="" class="label"><small>Email</small></label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukan email anda" value="{{ auth('user')->user()->email ?? '' }}"/>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="" class="label"><small>Password</small></label>
                                    <input type="password" name="password" class="form-control" placeholder="*********"/>
                                    <small class="text-danger">Kosongkan jika tidak ingin mengubah</small>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="" class="label"><small>ID Card</small></label>
                                    <div>
                                        <img src="{{ asset('img/' . auth('user')->user()->id_card) }}" alt="ID Card" width="200px"/>
                                    </div>
                                    <small class="text-danger">Hubungi admin jika ingin mengubah ID Card</small>
                                </div>
                            </div>
                            <div class="item-footer mt-3">
                                <button type="submit" class="btn btn-main w-100">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <x-app-footer-layout></x-app-footer-layout>

    </main>

</x-app-layout>