# Webhallen Cheevo Discord Notification

Get notified in Discord when you're able to get a day-specific [Achievement](https://www.webhallen.com/se/info/6-Medlem-hos-Webhallen#achievements) by ordering something from Webhallen.

![](https://github.com/tsjost/Webhallen-CheevoNotify/blob/assets/screenshot.png)

## Setup
* Clone the repo, copy `.env.sample` to `.env`
* Create a webhook in a Discord channel and insert it in the appropriate place in `.env`
* Optionally create a Discord role that will get notified, copy the role ID and insert it in the appropriate place in `.env`
	* Delete the entire `DISCORD_ROLE_ID=` line if role notification is not desired.

## Run
Execute `docker-compose up` and a container will spin up and run a cronjob every (Swedish time) midnight.
