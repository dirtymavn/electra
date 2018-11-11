# electra
Electra travel management for Sabre

## Form Rules
Untuk setiap form **Master data** dan form **Transactional**:
- Setiap form memiliki 1 button dropdown/split button dengan 3 pilihan: **Save as draft**, **Publish**, **Publish and continue**
- **Save as draft** akan menyimpan data form tsb dan status di set sebagai **draft**. Tidak redirect (masih di view yg sama)
- **Publish** akan menyimpan data form tsb dan status di set sebagai **published**. Redirect ke list form terkait
- **Publish and continue** akan menyimpan data form tsb dan status di set sebagai **published**. Redirect ke editor form yang sama, dengan posisi seluruh field blank / cleared.
- Status draft hanya bisa maju ke status published. Status published **tidak dapat** kembali menjadi draft

Untuk setiap list **Master data** dan form **Transactional**:
- List menampilkan seluruh data dari semua status(termasuk status draft)
- List menampilkan 3 fungsi pada ujung kanan baris per list : **View**, **Edit**, **Delete**
- List memiliki checkbox pada ujung kiri baris per list. Checkbox digunakan untuk bulk action
- Bulk action dropdown button pada bagian _list filter_ hanya dipergunakan untuk 2 hal : **bulk delete** atau **bulk edit status**

### General transaction rules

- Cascade lock : Data yang sudah dipakai sebagai FK di form lainnya tidak dapat dihapus. Penghapusan harus dilakukan berurut dari data terujung.

## Commit rules
Untuk setiap commit yang dilakukan harus mempertimbangkan perubahan data yang terjadi di sisi client. Berikut point yg perlu diperhatikan dalam perubahan yang mengubah struktur maupun menambah data. Staging server merupakan server yg digunakan sebagai _showcase_ aplikasi kepada client, dan akan melalui reset data per setiap commit push. Meskipun data di reset setiap kali di push, proses dibawah harus dilakukan untuk memastikan bahwa server staging / development memiliki cukup data untuk dilakukan _functional testing_ maupun _usability testing_. List data seed akan disediakan secara terpisah untuk menjamin kelancaran fungsionalitas.
1. Data yang akan dihapus harus di truncate secara keseluruhan (bukan hanya di delete)
2. Seed data disediakan Aurora dan Hendri, parallel dengan testing scenario

## Server configuration

- Ubuntu 16.04 LTS
- Secured server, key-only SSH. No clear password allowed
- UFW Firewall installed, opening OpenSSH & Apache2
- Apache2 installed, pointing at default configuration
- PostgreSQL installed, no password for _postgres_ user
- Staging server : 128.199.115.155
- Development server : 128.199.233.178



## Flow

1. All development should be done in *development* branch and tested by developer him/herself.
2. Upon complete testing (on developer machine), push to *testing* branch -> deploy to **development server** (128.199.233.178)
3. Tester test and note feedback of development server test result everyday
4. Once a week at the end of the week, upon PM approval, push weekly progress to **staging server** (128.199.115.155)

## Public Key

only public key below can access **both servers above**

#### Hendri
```
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCZE52W5pzDZ1PazZwo+fGvk0rhUpHOUiIBqeyrEDxF2Gl/N/fP19bIKso6oxZDY69Oxs11yVAEhl1TMjAGhBQ7uD5nKgCner3Aaakobwg07LsRmwoqRHrUA53s1wPcQXd9vAZgNI0ybFquEhi6dNRxG8YXjuH54mlpJ5s4Y8D7Lr0DwmugyqvJ4ftLrF1e6bSBMMBZu5SPOCqOLvbC62qkc4N7ynzyeJQ2xcpPEwlxJCnUBdvdpu4zcC1P0+0+OYozORmrjrU0v22RLhZD2He8wIeB/EPapaW68YkB634821UF2dqSipStKsVC8a1cf+BjapsvlQaTtYI95h/ffQEH folie@Kali.local
```

#### Yoga
```
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAACAQC3E9fG1DeJzCkjYOtcwp9xXFkAGRwQXFgL+0xCNsyqWNcYbKIAGrF/W0WCgEQHvVrzcVhna3/kQc0fdFZj/MK92HZTYsEOeE5m83ufBiAbK7x6iWM7xPD6tn3pdcdYnBr3+XhSFmLdKcEzzFUWKsixAXxw29NwMnmBHErVJGqGVQy/P4T+PVBGLiPJdlgeSak9mJw09laWzs5/G1Qm+FB1WacczqYYKkyRilflya3bo8qqHYmiw1DaDcXL5UaE6dqS2shRu5aCgK1L8IAmLATbYEXNQWyuyzHI4T/ZE8+cmj4icPAkPRsuAhqZ35VjXWVpNbMswI3IvL6Oeca61Q1bF1o718V0lrG5NyDIyCwzclsBEx6PF/ZLp87gKccfSyfYarHC+5AOSBEO3cSY922h97uKTfpqzksZhzW/P7oDfk9VGEhRmAHwrjVY4C2DaXoi08da8uZzOwjFmxFSZx0Pgb/ZrvrSx2I2I8miiMFH2zU0NzXGbirOkrj7YW7iygbV2BeyGimxf5GoJD5tLwAkt2zhiUD3RVktY02HFrj8NftauXLMPksf/UbdIzyAbniCP9IxA3ZGSSNPT3SndGiwtzRoFN9tgk86AgYH+9AAyKfLjMME9jDBEAd3kXKNsIrOK0kfyQnvVyWSnkjptBB/cUU6Z8LeTXa58lBNNQKEmQ== yoga.h@smooets.com
```

#### Fadly
```
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCiyeJcoDr+tcJGSknwxOWAHzJrF2YhtDnVeW4Z/fcTKnHjfm07U9K2ZKdYIKeFxIgJ9eMhIHd9guaQpJ6q4s6CA3JocPv0VOMSUaXdJj8zGg8ez7fIO7UMW09NGJKyWjUR6MIZcEKSSbG8yVcgjD8ryuzaSP6/7P/kxvMVO2AAJIEtHNECSGZX/IrAHzST31TU96UgFGQWScJ2QqPB2jh6yiXXUn6bgFuEtIDbTR4n/cOSLQfaeGAyPqpUJo7pQo+DuAAMO0HW1k28LPpiOMDPUWrRO315HF95g7MrAoT1BLw0kzDpXSbPnxFButBkiq9znCaFOPPPmAufQeVgkUgN fadly@fadly
```

## Example Auth
- username : superadmin
- password : 12345678


## Migration
hapus semua table dan isi dengan yang baru dan running seednya

``` composer dump-autoload ```

```  php artisan migrate:refresh --seed  ```
