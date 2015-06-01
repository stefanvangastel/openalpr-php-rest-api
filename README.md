PHP REST API script for OpenALPR
========

Prerequirements
--------
* A webserver is installed
* PHP >= 5.3 is installed
* OpenALPR is installed
  * Install / place [OpenALPR](https://github.com/openalpr/openalpr) on your system
  * Make sure the OpenALPR (alpr) binary is executable and in your path. `$ alpr --version` or `C:\> alpr --version` should work

Installation
--------
1. Clone the repo in your webserver document root: `git clone https://github.com/stefanvangastel/openalpr-php-rest-api.git`
2. Accessing the check.php script (eg. http://localhost/openalpr/check.php) should result in:
 ```
 {
 "error": "Error: No image data recieved. Please send a base64 encoded image"
 }
 ```
3. Use Postman or some other REST client tester to submit a form-data POST request to check.php containing an 'image' field / key with the following data / text:
 [Example data](https://gist.githubusercontent.com/stefanvangastel/0fdeef93f578a0add500/raw/ddc908aa1ceb0d51f97c4ef6ab1df0fcbea30205/porche.jpg)

4. This should result in the following JSON response, if so, it works: 
```
{
    "data": {
        "version": 2,
        "data_type": "alpr_results",
        "epoch_time": -1348550864,
        "img_width": 636,
        "img_height": 358,
        "processing_time_ms": 61.695,
        "regions_of_interest": [
            {
                "x": 0,
                "y": 0,
                "width": 636,
                "height": 358
            }
        ],
        "results": [
            {
                "plate": "56ZFDL",
                "confidence": 93.35331,
                "matches_template": 0,
                "plate_index": 0,
                "region": "",
                "region_confidence": 0,
                "processing_time_ms": 15.263,
                "requested_topn": -2084378561,
                "coordinates": [
                    {
                        "x": 243,
                        "y": 225
                    },
                    {
                        "x": 396,
                        "y": 227
                    },
                    {
                        "x": 396,
                        "y": 257
                    },
                    {
                        "x": 243,
                        "y": 255
                    }
                ],
                "candidates": [
                    {
                        "plate": "56ZFDL",
                        "confidence": 93.35331,
                        "matches_template": 0
                    },
                    {
                        "plate": "S6ZFDL",
                        "confidence": 85.164574,
                        "matches_template": 0
                    },
                    {
                        "plate": "56ZF0L",
                        "confidence": 84.503777,
                        "matches_template": 0
                    },
                    {
                        "plate": "56ZFOL",
                        "confidence": 83.140244,
                        "matches_template": 0
                    },
                    {
                        "plate": "B6ZFDL",
                        "confidence": 81.62719,
                        "matches_template": 0
                    },
                    {
                        "plate": "6ZFDL",
                        "confidence": 79.280426,
                        "matches_template": 0
                    },
                    {
                        "plate": "S6ZF0L",
                        "confidence": 76.315041,
                        "matches_template": 0
                    },
                    {
                        "plate": "S6ZFOL",
                        "confidence": 74.951508,
                        "matches_template": 0
                    },
                    {
                        "plate": "B6ZF0L",
                        "confidence": 72.777657,
                        "matches_template": 0
                    },
                    {
                        "plate": "B6ZFOL",
                        "confidence": 71.414124,
                        "matches_template": 0
                    }
                ]
            }
        ]
    }
}
```

