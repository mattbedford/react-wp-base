# A template to build you own React app inside WP
### (In the most WordPressy way possible)


## Reason why
Everyone loves React. Everyone loves WordPress (kinda), so this plugin tries to pull them together in a way which respects and tries to get the most out of both: load a fully-functional, minimum-effort React app inside of Wordpress (front-end or back) and __do it with WordPress tools (i.e. @wp-scripts)__

This guide is mostly for myself and other full-stack devs, especially those from a WP background who are wondering what to do with all their skills now WP has ***Gone to Gutenberg***. I've pulled it together from various sources around the net and which required a LOT of work to get up and running. And no, didn't want to pull in additional 3rd-party tools to help do this. 


## Prereqs
Install Node, LTS version. If you're really smart you'll do this with NVM. Also you'll need a WP install somewhere.

## Overview
1. Set up your WP environment, however you like. I love using wp-env, but Local or just a Docker are fine too.
2. Add a new plugin directory and use either a hook or a template file to output ```<div id="react-app">``` wherever you want your app to show up.
3. Enqueue the React script. Note that it doesn't exist yet, but it'll be created at ```your-plugin-dir/build/index.js'```.
4. Install ***@wp-scripts*** in the project root.
5. Modify the package.json, mapping the wp-scripts commands to NPM ones.
6. Run NPM install from root and wait for deps to be installed.
7. Add a new directory to root. Inside it create App.js (note the capital A) and index.js (note the small i)
8. Add a mini react script to prove it works.
9. Activate your plugin, run ```npm start``` (from root, always) then check your page to see it working.

> [!IMPORTANT] 
> You ***need*** to include ```'wp-element', 'wp-api-fetch', 'react-jsx-runtime'``` as dependencies when you enqueue your script.


>[!NOTE]
> Don't give up. I don't know if it's a cache thing or some behind-the-scenes magic going on with wp-scripts, but it sometimes takes quite a few reloads to see the script show up at first.
