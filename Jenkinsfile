pipeline {
    agent any
    environment {
        staging_server = "3.1.84.167"
        app_path = "/var/www/html/DailyExpenseSystem"
        ssh_key = credentials('ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCswEAgTJ0h8Z0m08z3PdRdAgG3YHrKM1vbSi7uXmctChy/J4aQQX+iW9dlNRIe1k+KLuF/V6TjvFsdX7eNkVgOBZAtTvA58W9fcAhyfDcwtyUt0VKHolJickDNpfwKTHQ3gZfo9eBwrqfxIW+WF6IFIOP8hyYaynp/YwkCth1ZMu6tW2AiIrqWGFBkw2r5uRZXUV14e+iFsssUeZgwljdMwk+qMLvFIOwVeLslijB6MuOIQAAR42anppt181gzXXRXQSOB6jPM74qnm3dyp9/JcQRizhPONagfSZwECDgBD4p0dPLafdEooUnp0BTRiDHkmJcB2/isjh9O1c3b6Fdn imported-openssh-key')
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
