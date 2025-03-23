Some tweaks I made to the original script so it can be evoked outside the terminal and showing the results as a Zenity Popup.
Thanks to AlexisWilke for the original script.







# Screensaver Inhibitor

A PHP script to list the current screensaver inhibitors.

The script queries the D-Bus system for processes that are currently running and preventing your screensaver from kicking in.

* Why do I want that?

    When I go to bed, I like to lock my screen, only in the morning at times it's on. That's becomes a process (often Firefox) has an inhibitor in effect. The idea of the script is to find out what those processes are and close that tab or tool for the night.
    
* Why do you want that?

    You may have the same problem as I, or maybe you want the computer to be locked at all times when you're not at the computer. The lock won't happen if you have an inhibitor in place.
    
    Another reason would be that you expect the computer to go to sleep/hibernation after a while and the inhibitors will again prevent that from happening and you'll use electricity the whole time when it should be hibernating.

* Why did we invent such things?

    Whenever someone watches a video, they usually don't move their mouse or type on the keyboard and the movie may be 2 or 3 hours long. For that long the computer should not go to sleep.

## About Firefox

Note that for Firefox you can just switch to another tab which doesn't require inhibition and it will drop out of the list. If you have multiple Firefox windows opened, then you may need to go to each one to fix them all. Other browsers may have the same feature. I didn't try. Such functionality is going to be on a per process. It's how these tools handle D-Bus and not how D-Bus works.
