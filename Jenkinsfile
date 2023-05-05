pipeline{
    agent any
    environment{
        staging_server="ip-172-31-18-160.ap-southeast-1.compute.internal"
    }
    stages{
        stage('Deploy PHP Project'){
            steps{
                sh "scp -r ${WORKSPACE}/* ssh root@${staging_server}:/var/www/html/DailyExpenseSystem/"
            }
        }
    }
}
