pipeline {
    agent any

    stages {
        stage('Deploy PHP Project') {
            steps {
                script {
                    def sshPublisher = sshPublisher(publishers: [sshPublisherDesc(configName: 'phpServer', transfers: [sshTransfer(cleanRemote: false, excludes: '', execCommand: '', execTimeout: 120000, flatten: false, makeEmptyDirs: false, noDefaultExcludes: false, patternSeparator: '[, ]+', remoteDirectory: '', remoteDirectorySDF: false, removePrefix: '', sourceFiles: '/var/www/html/DailyExpenseSystem/**')], usePromotionTimestamp: false, useWorkspaceInPromotion: false, verbose: false)])
                    sshPublisher.setFailOnError(true)
                    sshPublisher.perform()
                }
            }
        }
    }
}
