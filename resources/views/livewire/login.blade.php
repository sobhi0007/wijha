<div>
    <form wire:submit.prevent="submit">
                                    @csrf
                                    <div class="row d-flex justify-content-center  ">
                                        <div class="col-12 ">
                                            <div class="my-3">
                                                <div class="form-floating">

                                                    <input wire:model="email" value="{{ old('email') }}" required autofocus
                                                        dir="rtl" type="email"
                                                        class="form-control  rounded-lg text-start" id="Email"
                                                        placeholder="البريد الالكتروني">
                                                    <label for="Email"
                                                        class="form-label text-muted fw-bold">{{__('lang.email')}}</label>
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="my-3">
                                                <div class="form-floating">
                                                    <input wire:model="password" dir="rtl" type="password"
                                                        class="form-control  rounded-lg text-start" id="password"
                                                        placeholder="كلمه السر">
                                                    <label for="password"
                                                        class="form-label text-muted fw-bold">{{__('lang.password')}}</label>
                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="text-end">
                                                <button type="submit"  wire:loading.attr="disabled"
                                                    class="btn bg-main text-light rounded-lg py-2 px-3">{{__('lang.sginin_btn')}}</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
</div>
