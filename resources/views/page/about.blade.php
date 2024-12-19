@extends('layouts.guest')
@section('content')
    <div class="p-5 md:px-20 bg-neutral-100 min-h-screen">
        <div class=" rounded-md bg-white p-5 ">
            <a href="{{ route('landing-page') }}" class="mb-6 text-blue-700 text-sm font-medium block w-full">
                Kembali
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-blue-700 inline-block">
                    <path d="M9 10h6c1.654 0 3 1.346 3 3s-1.346 3-3 3h-3v2h3c2.757 0 5-2.243 5-5s-2.243-5-5-5H9V5L4 9l5 4v-3z"></path>
                </svg>
            </a>
            <h1 class="font-bold text-xl text-slate-800 mb-5">Tentang Zentech</h1>
            <p class="text-md text-slate-700 md:ps-10 mb-2 text-justify">Selamat datang di Zentech, tujuan utama Anda untuk
                segala
                kebutuhan
                teknologi!
                Kami adalah platform
                e-commerce
                terkemuka yang menyediakan berbagai alat teknologi terbaik, termasuk smartphone, laptop, dan berbagai
                perangkat
                elektronik lainnya. Di Zentech, kami berkomitmen untuk menawarkan produk berkualitas tinggi dengan harga
                yang
                kompetitif untuk mempermudah akses Anda ke dunia teknologi terkini.</p>

            <p class="text-slate-700 text-md mb-4 text-justify">
                Visi Kami adalah untuk menjadi penyedia perangkat teknologi yang dapat diandalkan, membantu Anda menemukan
                alat
                yang
                tepat untuk kebutuhan sehari-hari, pekerjaan, dan hiburan. Baik Anda seorang profesional yang membutuhkan
                laptop
                untuk produktivitas, penggemar teknologi yang ingin upgrade ke smartphone terbaru, atau siap untuk
                menjelajahi
                dunia
                gadget, kami memiliki berbagai pilihan yang dapat disesuaikan dengan setiap anggaran dan kebutuhan.
            </p>

            <p class="text-md font-medium mb-3 text-slate-800 text-justify"> Misi Kami adalah untuk menghadirkan pengalaman
                belanja yang mudah,
                aman, dan menyenangkan. Kami menawarkan:
            </p>
            <ul class="list-disc text-md text-slate-700 mb-2 ps-5 md:ps-10 text-justify">
                <li class="text-justify"><span class="font-semibold text-slate-800">Produk Terpercaya</span>: Kami hanya
                    menjual perangkat yang
                    telah teruji
                    kualitasnya dan dipilih dari
                    merek-merek
                    terbaik
                    di dunia.</li>
                <li class="text-justify">
                    <span class="font-semibold text-slate-800">Harga Bersahabat
                    </span>: Kami memahami pentingnya anggaran Anda, itulah mengapa
                    kami memberikan harga yang
                    sangat
                    bersaing untuk produk berkualitas tinggi.
                </li>
                <li class="text-justify"><span class="font-semibold text-slate-800">Pelayanan Pelanggan</span>: Kami selalu
                    siap membantu Anda,
                    baik sebelum
                    maupun
                    setelah pembelian. Tim customer
                    service
                    kami siap menjawab pertanyaan Anda dan memberikan dukungan yang Anda butuhkan.
                    Pengiriman</li>
                <li class="text-justify"><span class="font-semibold text-slate-800">Cepat dan Aman</span>: Kami memastikan
                    produk Anda sampai
                    dengan aman dan
                    tepat
                    waktu
                    ke tangan Anda, tanpa
                    hambatan.</li>
            </ul>



            <p class="text-md text-slate-700 mb-3 text-justify">Dengan berbagai pilihan produk dan kemudahan berbelanja,
                Zentech adalah
                tempat yang tepat untuk membeli alat
                teknologi yang Anda butuhkan. Temukan gadget impian Anda dan nikmati teknologi terbaru yang dapat
                mempermudah
                hidup
                Anda.</p>

            <p class="text-slate-800 text-md text-justify">Bergabunglah bersama kami di Zentech, temukan teknologi untuk
                kehidupan Anda!
            </p>
        </div>
    </div>
@endsection
