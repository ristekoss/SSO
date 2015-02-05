# SSO

Sebuah *library* PHP untuk memudahkan aplikasi menggunakan fasilitas login SSO Universitas Indonesia.

## Instalasi

### 1. Instalasi menggunakan Composer (disarankan)

Metode yang disarankan untuk menginstall *library* ini adalah dengan menggunakan Composer. Composer adalah sebuah *package manager* untuk PHP. Keuntungan metode ini adalah Anda dapat dengan mudah mendapatkan update melalui satu perintah `composer update`. Selain itu, Anda juga dapat mengakses *library* ini dengan mudah apabila Anda menggunakan framework yang juga menggunakan Composer, misalnya Laravel atau Yii2.0. Anda dapat membaca lebih lanjut tentang Composer [di sini](https://getcomposer.org/).

Untuk meng-*install* *library* ini, ikuti langkah berikut.

1. *Install* Composer. ([Lihat caranya](https://getcomposer.org/doc/00-intro.md))
2. Tambahkan dependensi berikut ke file composer.json yang ada di *root* project Anda (atau buat baru jika belum ada).
        
        {
            "require": {
                "ristek/sso": "*"
            }
        }

3. *Install* library ini dengan menjalankan perintah berikut pada terminal:

        composer install

    Langkah ini dapat memakan waktu beberapa menit tergantung koneksi Anda.
4. *Require* autoload.php dari composer di file Anda (lewati langkah ini jika Anda menggunakan framework berbasis Composer, misalnya Laravel):
        
        <?php
            require "vendor/autoload.php";

Anda sekarang sudah dapat menggunakan library ini.

### 2. Instalasi manual

Untuk menggunakan *library* ini secara manual (tanpa Composer), ikuti langkah berikut.

1. Download *library* phpCAS dari [sini](http://downloads.jasig.org/cas-clients/php/current.tgz) dan ekstrak ke suatu tempat di project Anda, misalnya pada direktori `vendor`.
2. Download project ini sebagai zip (lihat bagian atas kanan halaman ini), ekstrak juga ke `vendor`.
3. *Require* `SSO.php` dengan melakukan:
        
        <?php
            require "vendor/SSO/SSO.php";

4. Anda kemudian harus spesifikasikan *path* ke `CAS.php` (ada di library phpCAS yang Anda download di langkah 1), seperti ini:
        
        <?php
            $cas_path = "path/to/CAS.php";
            SSO\SSO::setCASPath($cas_path);

Sekarang *library* ini sudah dapat digunakan.

## Penggunaan

Anda dapat melihat contoh penggunaan pada file `example.php` dan `example-manual.php`.

### 1. Otentikasi

    SSO\SSO::authenticate();

Pemanggilan ini akan melakukan *redirect* browser ke login SSO. Jika otentikasi user berhasil, fungsi ini akan mengembalikan nilai boolean `true`. Anda dapat mengasumsikan bahwa setelah pemanggilan fungsi ini, user telah berhasil diotentikasi.

### 2. Mendapatkan detail user

    SSO\SSO::getUser();

Fungsi `getUser()` akan mengembalikan sebuah object `stdClass` PHP yang memiliki detail dari user yang berhasil diotentikasi. Potongan kode berikut mengilustrasikan penggunaannya:

    $user = SSO\SSO::getUser();
    echo $user->username;           // prints user's username
    echo $user->name;               // prints user's name
    echo $user->npm;                // prints user's npm
    echo $user->role;               // prints user's role

### 3. Memeriksa otentikasi

    SSO\SSO::check();

Pemanggilan ini akan mengembalikan true jika user sudah pernah berhasil otentikasi dan false jika sebaliknya.

### 4. Log Out

    SSO\SSO::logout();

Pemanggilan ini akan mengakhiri otentikasi user.

### 5. Setting path untuk CAS.php

    SSO\SSO::setCASPath($cas_path);

Fungsi ini digunakan ketika Anda tidak menginstall via Composer. Ia mengeset lokasi file `CAS.php` yang akan digunakan oleh *library* SSO.

## Tips: Menghilangkan namespace

Anda banyak melihat pemanggilan `SSO\SSO` di sini. Kadang itu membuat kode Anda buruk dan tidak mudah dibaca. Anda dapat menghilangkannya dengan satu statement berikut:

    use SSO\SSO;

Setelah itu Anda akan dapat menghilangkan awalan `SSO\`, seperti ini:

    SSO::authenticate();
    $user = SSO::getUser();

