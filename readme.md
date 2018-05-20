# electra
Electra travel management for Sabre

## Server configuration

- Ubuntu 16.04 LTS
- Secured server, key-only SSH. No clear password allowed
- UFW Firewall installed, opening OpenSSH & Apache2
- Apache2 installed, pointing at default configuration
- PostgreSQL installed, no password for _postgres_ user
- External IP : 206.189.145.216


## Credential

(username/password)
- deploy : Deploy123*
- PostgreSQL : postgres/(blank)
- PostgreSQL : root/(Root123*)

### Mailgun

- IP Adress : 184.173.153.201 
- SMTP Hostname : smtp.mailgun.org
- Default SMTP Login : postmaster@mg.wckd.xyz
- API Base url : https://api.mailgun.net/v3/mg.wckd.xyz
- Password : 4c7fd206a7c28e0a24f99a89ea7928a1
- API Key : key-a4d8200fc6655d20b40569b6d2dc3b29

## Flow

1. All development should be done in *development* branch and tested by developer him/herself.
2. Upon complete testing (on developer machine), push to *testing* branch -> deploy to **development server** (206.189.145.216 - digitalocean)
3. Tester test and note feedback of development server test result everyday
4. Once a week at the end of the week, upon PM approval, push weekly progress to staging server (xxx.xxx.xxx.xxx - AWS)

## Public Key

only public key below can access **development server** (206.189.145.216)

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