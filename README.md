
# Immanuel API

A simple, [Lumen](https://lumen.laravel.com/)-based astrology API powered by the [Immanuel Chart](https://github.com/sunlight/immanuel-chart) package. User accounts are required for access, with basic validation, quota-handling and request-logging built in. Both an API key and an API secret are required for access, which can be passed either in the `Authorization` header, or directly as POSTed fields `api_key` and `api_secret`. The key is hashed using `sha256`, and the secret is hashed using Laravel/Lumen's `Hash::make()`. Therefore any application generating a key/secret pair will need to flash these values to the user when storing in the user's account, as they will not be retrievable.

## Methods

Immanuel API currently provides three simple yet powerful API methods for getting detailed astrological chart data in JSON format, all of which accept the following POSTed birth chart data:

* `latitude`: the standard latitude of the chart's location.
* `longitude`: standard longitude.
* `birth_date`: YYYY-MM-DD-formatted chart date.
* `birth_time`: 24-hour HH:MM-formatted chart time.
* `house_system`: one of the accepted house systems as defined by the [Immanuel Chart](https://github.com/sunlight/immanuel-chart) package.
* `solar_return_year`: YYYY-formatted year required for solar return charts.
* `progression_date`: YYYY-MM-DD-formatted date required for progressed charts.

The three available chart methods are:

* `/chart/natal/` for a basic natal chart.
* `/chart/solar/` for a solar return chart.
* `/chart/progressed` for a progressed chart.

Pretty simple! Data is returned as a JSON array with detailed information on the planets, angles, points, signs, houses and aspects.

## Usage

This API can be installed and used on any Lumen-supporting server that can also run Python scripts, since the [Immanuel Chart](https://github.com/sunlight/immanuel-chart) package it relies on generates chart data via a Python script at its core. Otherwise you can access the [Immanuel](https://immanuel.app) project's ready-built API for free - see the website for examples and to sign up for your free API account.