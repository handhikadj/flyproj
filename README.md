# Livewire - Ping Time Checker

#### a simple Livewire component which enables you to measure ping time to the server which runs once per second.

## Problem

One day when you want to add some kind of diagnostic tool to your site to measure ping time from your current location to your own server.
You have no clue or probably too lazy to code to measure the ping time, and you want it to keep it running per second...

## Solution

By using this component, it's painlessly straightforward. 
The component provides a button to trigger it and a text to show the ping time in milliseconds.
It should take seconds to set up.

#### Installation

- Copy `ping-checker.blade.php` under `views/livewire` directory and `PingChecker.php` under `Http/Livewire` directory to your Laravel Livewire project.
- Add `<livewire:ping-checker />` to a blade template or a Livewire component.
- And you should be good to go.

This is how it would look on your site:

<img src="/how-it-works.gif" alt="img" />

#### How to run it.

As shown on the short video above, you can click the "Check Ping" button and the ping time will appear below it.

#### How does it work?

The nitty-gritty work lies on the `<script>` tag on `views/ping-checker.blade.php`.
Scroll down to see the code explanation.

```js
<script>
    let isPingInitiated = false;

    document.getElementById('check-button').onclick = () => {
      isPingInitiated = true;
    }

    setInterval(async () => {
      const startTime = new Date().getTime();

      if (isPingInitiated) {
        await fetch('/');

        const responseTime = new Date().getTime() - startTime;
        document.getElementById('ping-result').innerText = `${responseTime} ms`;
      }
    }, 1000);
</script>
```

#### Code Explanation

When page loads, we run the interval once per second. 
The interval won't do anything until the user clicks the "Check Ping" button.
When user clicks the "Check Ping" button, we set the `isPingInitiated` to `true`, thus the interval will do the measurement.
It measures how long the AJAX call finishes by subtracting the current time and the time when the AJAX call resolves regardless it succeeds or not.
It shows the ping time in milliseconds.

## Discussion

If you ask whether the button and the ping time text can be styled, the answer is absolutely yes. 
You have the blade template at your disposal. Style the elements using CSS or any UI frameworks out there whatever you'd like.

I absolutely agree that this kind of diagnostic tool is very uncommon to see on websites. 
It's up to you to see this app as useful or not.
To me, there's probably one time when this tool might be useful, for example when you feel your site is unresponsive and wondering how much the ping time you'll be getting.
You visit your site, you clicked the "Check Ping" button, and you find yourself getting high ping time from your server, then your server might be having heavy load due to decreased bandwidth.
