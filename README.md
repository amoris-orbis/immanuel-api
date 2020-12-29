# Immanuel API

Immanuel API is a lightweight Lumen-based REST API for retrieving astrological data. Under the hood it uses the [Immanuel Chart](https://github.com/theriftlab/immanuel-chart/) Lumen package which runs a Python script.

## Usage

All requests to the API must be authenticated with a key & secret. These can be sent either in the request's `Authorization` header, or as fields in the POST data itself, named `api_key` and `api_secret`.

The API data for up to three charts to be returned - _natal_, _solar return_, _progressed_ and _synastry_ are available, and you may request up to two of these types. Tou can also optionally add transits to make it three. Data will be returned as a JSON object, either as a single objet representing the main chart's data if only one chart is requested, or an object of multiple chart data objects if multiple charts are requested. In this latter case, the keys will be `primary`, `secondary`, and if requested `transits`. You can also specify which chart's planets the main `primary` chart's aspects apply to. By default this will be its own planets as standard, but you can also request its aspects point to the `secondary` or `transit` chart's planets - useful for synastries and transits. For example:

* `/chart/natal` returns a natal chart.
* `/chart/solar/transits` returns a solar return chart with transits.
* `/chart/natal/synastry` returns a natal chart and a second synastry chart.
* `/chart/natal/synastry/transits` returns same with added transits.

The following data must be POSTed to _all_ of the above methods:

* `birth_date` - YYYY-MM-DD-formatted chart date.
* `birth_time` - 24-hour HH:MM-formatted chart time.
* `latitude` - the standard latitude of the chart's location.
* `longitude` - standard longitude.
* `house_system` - one of the accepted house systems.

Accepted house systems are: _Placidus, Koch, Porphyrius, Regiomontanus, Campanus, Equal, Equal 2, Vehlow Equal, Whole Sign, Meridian, Azimuthal, Polich Page, Alcabitus,_ and _Morinus_. Some methods require additional data:

For solar return charts:

* `solar_return_year` - YYYY-formatted year.

For progressed charts:

* `progression_date` - YYYY-MM-DD-formatted date.

For synastry charts:

* `synastry_date` - YYYY-MM-DD-formatted chart date.
* `synastry_time` - 24-hour HH:MM-formatted chart time.
* `synastry_latitude` - the standard latitude of the chart's location.
* `synastry_longitude` - standard longitude.

There are also several optional arguments. For example if you have moved significantly far from your birth place, you can provide coordinates for your solar return chart or progressed chart, and also provide a date, time and/or coordinates for your transits.

* `solar_return_latitude`
* `solar_return_longitude`
* `progression_latitude`
* `progression_longitude`
* `transit_latitude`
* `transit_longitude`
* `transit_date`
* `transit_time`