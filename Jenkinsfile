pipeline {
    agent any

    stages {
        stage('Deploy PHP Project') {
            steps {
                sshPublisher(publishers: [sshPublisherDesc(configName: 'phpServer', transfers: [sshTransfer(cleanRemote: false, excludes: '', execCommand: '', execTimeout: 120000, flatten: false, makeEmptyDirs: false, noDefaultExcludes: false, patternSeparator: '[, ]+', remoteDirectory: '/var/www/html/', remoteDirectorySDF: false, removePrefix: '', sourceFiles: '**/*.php, /var/www/html/DailyExpenseSystem/**')], usePromotionTimestamp: false, useWorkspaceInPromotion: false, verbose: false)])
            }
        }
    }
}
