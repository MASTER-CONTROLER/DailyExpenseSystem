pipeline {
    agent any
    environment {
        staging_server = "3.1.84.167"
        app_path = "/var/www/html/DailyExpenseSystem"
        ssh_key = credentials('MIIEpQIBAAKCAQEArMBAIEydIfGdJtPM9z3UXQIBt2B6yjNb20ou7l5nLQocvyeG
kEF/olvXZTUSHtZPii7hf1ek47xbHV+3jZFYDgWQLU7wOfFvX3AIcnw3MLclLdFS
h6JSYnJAzaX8Ckx0N4GX6PXgcK6n8SFvlheiBSDj/IcmGsp6f2MJArYdWTLurVtg
IiK6lhhQZMNq+bkWV1FdeHvohbLLFHmYMJY3TMJPqjC7xSDsFXi7JYowejLjiEAA
EeNmp6abdfNYM110V0EjgeozzO+Kp5t3cqffyXEEYs4TzjWoH0mcBAg4AQ+KdHTy
2n3RKKFJ6dAU0Ygx5JiXAdv4rI4fTtXN2+hXZwIDAQABAoIBAQCklxNB8tzvX020
la2+jvlLmELcXZ8AEcjd+SMX13gEMJNNCTKrNMyPe2OQuOzH1ra32IzekDm5BVfm
d7Dhv+4ehexlTsWQ31iWnJ5fvbuzvXs92ScBtYU66NKXXSLzCP7dd6qtub4afj3i
f1Hati+XJUwy6O1EL1BhGJGYNL1noo7+24njHYpowdBHRiPfpaHkOHOpaLgnoMer
wTZtu/WuEsI//5CBK+bVZjuPMeGujbVA+QCiDv1EkY0aHmMJvYEydqVJKra1PB+x
e1C9G4JyU0FN9PoSLafunRNUeXdwAqjMISjniNKNbgMQfECNgfd/PprBkoF2lgYk
d9shUJZZAoGBAN2mpachM2rK0UMxibBevr5IDkta8qGkPXiKLbK4iKXLLmkUN9O8
srv1rgu9lM3o2Hft+AlgGj/yIX31NKz9IvS4qth1Mygk6lwEX5rZg4msLsur5N6r
Vq4eqmpanML582aO81iH8hRsR2wFcA0wzusofvsQentSN3nB2ZUXAsmDAoGBAMeF
o7/4gw1urU1bzebYBul3WilmLA09O/GKCNipQxxp6mPoVdkvLTeiSDo78MXvPzCV
DX88fn3BVigcUhESlP7F4o5OAWWudjprDaONBpsfvYXGWIf+c/YYGg4WzRAoHhnK
i7JR+y8EwrkX/b5SuLkJzORyyLECyKLw8bYZ+WlNAoGBAN2E4WWo/tQqIv3+kldc
OVG+fdq96GO321+O6aEGYDsiVx3ZgPnySscjAHDnZcJshXtGr2/fRhzGhsZ1u9Fv
o/HkZYqzhw8F5dtU25/M53M+S/5tqu0HXDfkmfh02traJ3JGR9og88WJec/xl0z3
jLTk4hNVIrQBNURQgn5IYxa1AoGBAKiVq9HWGm2sGbSmoGiwGc8E8OLQGOKq3c5u
MqFXC4SjndADDR6wtQUwEtVZtkyYpYzYNIpQxBRf2vuTSmhwigJnk9Fn6dhPvEgK
EoEh9PX3sLyq5j0qbDMBFGrZKzW+oAhs0vK+QH3vCNU6h0VcQgbfWAejUR332y2K
ZsHWWp51AoGAPkad39qMMqC27PVcBxwSEGxgqy8uG8TyZ/dO8kYtcQQG9rYDSGYs
lYjJhOlznMcgC9tMVhTxLifGbR5ie2cW8qdfPzZ0nwmhip6gG8okYv3dzdjGf73j
2JbsBjP2yvxTZVYYhHqTkkl8HVni17A9rohe2vaxXXrT1TIYu9XKaLM=')
    }
    stages {
        
        stage('Install dependencies') {
            steps {
                sh 'composer install'
            }
        }
        stage('Build assets') {
            steps {
                sh 'npm install'
                sh 'npm run prod'
            }
        }
        stage('Deploy to staging server') {
            steps {
                withCredentials([sshUserPrivateKey(credentialsId: ssh_key, keyFileVariable: 'SSH_KEY')]) {
                    sh "scp -i ${SSH_KEY} -r * root@${staging_server}:${app_path}"
                }
            }
        }
    }
}
