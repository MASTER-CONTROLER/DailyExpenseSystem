pipeline{
    agent any
    environment{
        staging_server="3.1.84.167"
    }
    stages{
        stage('Deploy PHP Project'){
            steps{
                sh '''
                    for fileName in `find ${WORKSPACE} -type f -mmin -10 | grep -v ".git" | grep -v "Jenkinsfile"`
                    do
                        fil=$(echo ${fileName} | sed 's/'"${JOB_NAME}"'/ /' | awk {'print $2'})
                        scp -r ${WORKSPACE}${fil} root@${staging_server}:/var/www/html/DailyExpenseSystem${fil}
                    done
                '''
            }
        }
    }
}
