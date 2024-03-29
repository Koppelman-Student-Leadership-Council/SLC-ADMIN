cap:
	git coa "${m}"
	git poh

   
PAGE=192.254.225.2
THIS_BRANCH=official-key
MASTER_BRANCH=master
DEPLOY_BRANCH=deployment
FTP_USER=slcadmin@admin.brooklynslcouncil.com
FTP_PASSWORD=slcadmin

merp:
	git add --all
	git commit -m "Deployment" 
	git push origin HEAD
	make ft-push
	git checkout ${DEPLOY_BRANCH}
	git pull
	git merge ${THIS_BRANCH}
	git push origin HEAD
	git checkout ${THIS_BRANCH}

merge-to-deployment:
	git checkout ${DEPLOY_BRANCH}
	git pull
	git merge ${THIS_BRANCH}
	git push origin HEAD
	git checkout ${THIS_BRANCH}

mastermerge-deployment:
	git checkout ${MASTER_BRANCH}
	git pull
	git merge ${THIS_BRANCH}
	git push origin HEAD
	git checkout ${DEPLOY_BRANCH}
	git pull
	git merge ${MASTER_BRANCH}
	git push origin HEAD
	git checkout ${THIS_BRANCH}

ft-push:
	git ftp push 
	echo "open in ${PAGE}" && git log -n 2
	
ft-configpush:
	git config git-ftp.url ${PAGE}
	git config git-ftp.user ${FTP_USER}
	git config git-ftp.password ${FTP_PASSWORD}
	git ftp push --force


ftpinit:
	git config git-ftp.url ${PAGE}
	git config git-ftp.user ${FTP_USER}
	git config git-ftp.password ${FTP_PASSWORD}

first-deploy:
	make ftpinit
	git ftp init