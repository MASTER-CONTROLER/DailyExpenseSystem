pipeline {
    agent any

    stages {
        stage('Deploy PHP Project') {
            steps {
                sshPublisher(publishers: [sshPublisherDesc(configName: 'phpServer', transfers: [sshTransfer(cleanRemote: false, excludes: '', execCommand: '', execTimeout: 120000, flatten: false, makeEmptyDirs: false, noDefaultExcludes: false, patternSeparator: '[, ]+', remoteDirectory: '/var/www/html/DailyExpenseSystem/', remoteDirectorySDF: false, removePrefix: '', sourceFiles: '.')], usePromotionTimestamp: false, useWorkspaceInPromotion: false, verbose: false)])
            }
        }
    }
}
