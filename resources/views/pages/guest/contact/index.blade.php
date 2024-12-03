<x-landing-layout>
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl lg:text-5xl">
                    Kontak Kamiv
                </h1>
                {{-- <p class="mt-4 text-2xl text-gray-600">
                    dengan Kursus Design dan Coding dari Kelas Gratis
                </p> --}}
                <p class="mt-4 text-gray-600 text-xs">
                    Kontak
                    Terima kasih telah mengunjungi platform kami! Kami sangat bersemangat untuk memberdayakan individu
                    dalam menguasai dunia desain dan koding. Jika Anda memiliki pertanyaan, membutuhkan bantuan, atau
                    ingin mengetahui lebih lanjut tentang kursus online yang kami tawarkan, jangan ragu untuk
                    menghubungi kami. Kami siap membantu Anda dalam perjalanan belajar dan sukses di lanskap digital
                    yang terus berkembang.
                </p>

                <hr class="mt-6">
            </div>
        </div>
    </section>

    <section class="py-6 lg:py-10 xl:py-12 2xl:py-16">
        <div class="max-w-[90%] xl:max-w-[80%] mx-auto p-4 lg:grid grid-cols-12 lg:gap-4 xl:gap-10 2xl:gap-20 sm:p-6 lg:p-12 xl:lg-p-16 bg-white rounded-lg">
            <div class="col-span-8">

                <div class="grid xl:grid-cols-2 xl:gap-8 xl:mb-5">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-medium">First Name</span>
                        </div>
                        <input type="text" placeholder="Enter first name"
                            class="input input-bordered w-full border-[#F1F1F3] border active:ring-0 focus:ring-0 " />
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-medium">Last name</span>
                        </div>
                        <input type="text" placeholder="Enter last name"
                            class="input input-bordered w-full border-[#F1F1F3] border active:ring-0 focus:ring-0 " />
                    </label>
                </div>
                <div class="grid xl:grid-cols-2 xl:gap-8 xl:mb-5">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-medium">Email</span>
                        </div>
                        <input type="email" placeholder="Enter email"
                            class="input input-bordered w-full border-[#F1F1F3] border active:ring-0 focus:ring-0 " />
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-medium">Phone Number</span>
                        </div>
                        <input type="text" placeholder="Enter phone number"
                            class="input input-bordered w-full border-[#F1F1F3] border active:ring-0 focus:ring-0 " />
                    </label>
                </div>
                <label class="form-control w-full xl:mb-5">
                    <div class="label">
                        <span class="label-text font-medium">Subject</span>
                    </div>
                    <input type="text" placeholder="Enter subject"
                        class="input input-bordered w-full border-[#F1F1F3] border active:ring-0 focus:ring-0 " />
                </label>

                <label class="form-control">
                    <div class="label">
                        <span class="label-text font-medium">Message</span>
                    </div>
                    <textarea class="textarea textarea-bordered" rows="5" placeholder="Enter your message here ..."></textarea>
                </label>

                <div class="flex justify-end">
                    <button class="btn btn-primary mt-5 text-white">Kirim Pesan</button>
                </div>
            </div>
            <div class="col-span-4 space-y-8 max-lg:mt-6">
                <div class="bg-[#FCFCFD] border-[#F1F1F3] border rounded-lg p-5 space-y-3">
                    <div class="flex justify-center items-center gap-3">
                        <div
                            class="bg-[#F7F7F8] border-[#F1F1F3] size-12 flex justify-center items-center border rounded-md">
                            <img src="{{ asset('images/icons/mail.svg') }}" alt="email" width="20px">
                        </div>
                    </div>
                    <p class="text-center text-[#4C4C4D] mx-auto">support@kelasgratis.id</p>
                </div>
                <div class="bg-[#FCFCFD] border-[#F1F1F3] border rounded-lg p-5 space-y-3">
                    <div class="flex justify-center items-center gap-3">
                        <div
                            class="bg-[#F7F7F8] border-[#F1F1F3] size-12 flex justify-center items-center border rounded-md">
                            <img src="{{ asset('images/icons/phone.svg') }}" alt="email" width="20px">
                        </div>
                    </div>
                    <p class="text-center text-[#4C4C4D] mx-auto">+1998121001</p>
                </div>
                <div class="bg-[#FCFCFD] border-[#F1F1F3] border rounded-lg p-5 space-y-3">
                    <div class="flex justify-center items-center gap-3">
                        <div
                            class="bg-[#F7F7F8] border-[#F1F1F3] size-12 flex justify-center items-center border rounded-md">
                            <img src="{{ asset('images/icons/pin.svg') }}" alt="email" width="20px">
                        </div>
                    </div>
                    <p class="text-center text-[#4C4C4D] mx-auto">Jakarta, Indonesia</p>
                </div>
                <div class="bg-[#FCFCFD] border-[#F1F1F3] border rounded-lg p-5 space-y-3">
                    <div class="flex justify-center items-center gap-3">
                        <div
                            class="bg-[#F7F7F8] border-[#F1F1F3] size-12 flex justify-center items-center border rounded-md">
                            <img src="{{ asset('images/icons/facebook.svg') }}" alt="email" width="20px">
                        </div>
                        <div
                            class="bg-[#F7F7F8] border-[#F1F1F3] size-12 flex justify-center items-center border rounded-md">
                            <img src="{{ asset('images/icons/twitter.svg') }}" alt="email" width="20px">
                        </div>
                        <div
                            class="bg-[#F7F7F8] border-[#F1F1F3] size-12 flex justify-center items-center border rounded-md">
                            <img src="{{ asset('images/icons/linkedin.svg') }}" alt="email" width="20px">
                        </div>
                    </div>
                    <p class="text-center text-[#4C4C4D] mx-auto">Jakarta, Indonesia</p>
                </div>
            </div>

        </div>
    </section>

</x-landing-layout>
