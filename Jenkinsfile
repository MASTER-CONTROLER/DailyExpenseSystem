pipeline{
    agent any
    environment{
        staging_server="3.1.84.167"
    }
    stages{
        stage('Deploy PHP Project'){
            steps{
                sh 'scp -r ${WORKSPACE}/* ec2-user@{staging_server}:var/www/html/DailyExpenseSystem/'
            }
        }
    }
}
