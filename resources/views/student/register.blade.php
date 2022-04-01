<x-student.layout>
    <x-student.static-background-container>
        <div x-data="data">
            <template x-if="step == 1">
                <div  class="w-full" style="height:75vh">
                    <div class="backdrop-brightness-50 backdrop-blur-sm p-4">
                        <x-scholar.page.typing message="Hello there! I’m Antonina, your Admin Clerk. To enjoy the full Berkeley-Reagan University experience, please enrol." delay="10" clear="0" class="text-white"/>
                        <div class="flex justify-end">
                            <button class="btn-student-active mt-4" x-on:click="step++">
                                Ok
                            </button>
                        </div>
                    </div>
                    <img src="/students/character/antonina-half.png" alt="Antonina" class="avatar">
                </div>
            </template>

            <template x-if="step == 2">
                <div class="w-full" style="height:75vh">
                    <div class="backdrop-brightness-50 backdrop-blur-sm p-4">
                        <x-scholar.page.typing message="Welcome to Berkeley-Reagan University. Let's enrol you, shall we?" delay="10" clear="0" class="text-white"/>
                        <div class="flex justify-end  mt-4">
                            <button class="btn-student-active mx-2" x-on:click="step++">
                                Ok
                            </button>
                            <button class="btn-student mx-2" x-on:click="step--">
                                Next Time
                            </button>
                        </div>
                    </div>
                    <img src="/students/character/antonina-half.png" alt="Antonina" class="avatar">
                </div>
            </template>
            <div class="w-full  justify-center overflow-auto" x-show="step == 3">
                <form action="" class="w-11/12 pb-4 mx-auto mt-4 relative backdrop-brightness-50">
                    @csrf
                    <h2 class="bg-black text-white p-1 font-bold uppercase">Registration</h2>
                    <div class="px-4">
                        <x-student.form.input name="first_name" label="First Name"/>
                        <x-student.form.input name="last_name" label="Last Name"/>
                        <x-student.form.input name="user_name" label="BRU Name"/>
                        <x-student.form.select name="gender" label="Gender">
                            <option value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
                            <option value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
                            <option value="{{\App\Models\User::GENDER_LGBT}}">{{\App\Models\User::GENDER_LGBT}}</option>
                        </x-student.form.select>
                        <x-student.form.select name="sex" label="Sex">
                            <option value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
                            <option value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
                        </x-student.form.select>
                        <x-student.form.date name="birth_date" label="Birthdate"/>
                        <x-student.form.input name="address" label="Address"/>
                        <x-student.form.input name="city" label="City"/>
                        <x-student.form.select name="country" label="Country">
                            @foreach (\App\Helpers\CountryHelper::getAllCountries() as $key => $val)
                                <option value="{{$key}}">{{$val}}</option>
                            @endforeach
                        </x-student.form.select>
                        <x-student.form.input type="email" label="Email" name="email"/>
                        <x-student.form.input type="password" label="Password" name="password"/>
                        <x-student.form.input type="password" label="Confirm Password" name="password_confirmation"/>
                        <x-student.form.checker title="ARE YOU SURE ABOUT ALL THE INFORMATION YOU HAVE DECLARED?">
                            I certify that all information I have declared in this registration are true and correct to the best of my knowledge. I further understand that any false statement may result in denial or revocation of my account.
                        </x-student.form.checker>
                        <x-student.form.checker title="COPYRIGHT CERTIFICATION">
                            This is to reaffirm my duty to ensure all materials under my name and account in the BRUMULTIVERSE site and/or app are my property, and that I own the rights to them or I have obtained approval in writing to use them, as stated in my contract with BRUMULTIVERSE.
                        </x-student.form.checker>
                        <x-student.form.checker title="TERMS AND CONDITIONS">
                            I have read and I agree with the <a class="underline" href="/terms-and-conditions" target="_blank">Terms and Conditions</a>.
                        </x-student.form.checker>
                        <x-student.form.checker title="DATA PRIVACY">
                            I have read and I agree with the <a class="underline" href="/terms-and-conditions" target="_blank">Privacy Policy.</a>
                        </x-student.form.checker>
                        <x-student.form.submit>
                            Submit
                        </x-student.form.submit>
                    </div>
                </form>
            </div>
        </div>
    </x-student.static-background-container>
    @push('body-script')
        <script>
            var data = {
                step:0,
                init () {
                    window.onload = () => this.step = 1;
                },
            }
        </script>
    @endpush
</x-student.layout>
