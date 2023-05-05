pipeline{
    agent any
    environment{
        staging_server="172.31.18.160"
    }
    stages{
        stage('Deploy PHP Project'){
            steps{
                sh 'scp -r ${WORKSPACE}/* root@{staging_server}:var/www/html/DailyExpenseSystem/'
            }
        }
    }
}
