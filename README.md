# Easy Publicate
Simple API that parses information from
```.http
https://scholar.google.com/citations
https://scopus.com/
```

## Install Package
```
composer require m.rahimi/easy-publicate
```

## Scholar API
Endpoint           | **GET** Easy-Publicate/api/v1/scholar
------------------ | --------------------------------------------
Query Parameters   | user  ( like: vth4SIcAAAAJ )

<br/>

Response:
```json
{
    "http_status": 200,
    "http_message": "OK",
    "data": {
        "user_name": "Shyhtsun Felix Wu",
        "user_university": "University of California, Davis",
        "user_email": "Verified email at cs.ucdavis.edu - Homepage",
        "citatoins": "7283",
        "last_five_year_citatoins": "1583",
        "h_index": "46",
        "i10_index": "114",
        "citations_per_year": {
            "1999": "35",
            "2000": "61",
            "2001": "85",
            "2002": "127",
            "2003": "227",
            "2004": "324",
            "2005": "400",
            "2006": "489",
            "2007": "400",
            "2008": "396",
            "2009": "399",
            "2010": "360",
            "2011": "451",
            "2012": "419",
            "2013": "420",
            "2014": "429",
            "2015": "400",
            "2016": "369",
            "2017": "333",
            "2018": "315",
            "2019": "273",
            "2020": "209",
            "2021": "82"
        },
        "publications": [
            {
                "title": "Measuring message propagation and social influence on Twitter. com",
                "authors": "S Ye, SF Wu",
                "venue": "International conference on social informatics, 216-231, 2010",
                "citedBy": "366",
                "year": "2010"
            },
            {
                ...
            }
        ]
    }
}
```
## Scopus API
Scopus has ready to use API`s from https://dev.elsevier.com/
in this i use two api:

### 1. Search Api
Endpoint           | **GET** https://api.elsevier.com/content/search/scopus
------------------ | ------------------------------------------
Headers            | X-ELS-APIKey: Your API KEY
Query Parameters   | query  ( like: AU-ID("35560470450") or AUTHOR-NAME("Smith, George D.") )

<br/>

**NOTE:** The information in the table above is the minimum requirements for each request.

*for more information about this api: [Scopus Search API](https://dev.elsevier.com/documentation/SCOPUSSearchAPI.wadl)*

Response:
```json
{
    "search-results": {
        "opensearch:totalResults": "281",
        "opensearch:startIndex": "275",
        "opensearch:itemsPerPage": "25",
        "opensearch:Query": {
            "@role": "request",
            "@searchTerms": "AU-ID(\"35560470000\")",
            "@startPage": "275"
        },
        "link": [
            {
                "@_fa": "true",
                "@ref": "self",
                "@href": "https://api.elsevier.com/content/search/scopus?start=275&count=25&query=AU-ID%28%2235560470000%22%29",
                "@type": "application/json"
            },
            {
                ...
            }
        ],
        "entry": [
            {
                "@_fa": "true",
                "link": [
                    {
                        "@_fa": "true",
                        "@ref": "self",
                        "@href": "https://api.elsevier.com/content/abstract/scopus_id/0034867618"
                    },
                    {
                        ...
                    }
                ],
                "prism:url": "https://api.elsevier.com/content/abstract/scopus_id/0034867618",
                "dc:identifier": "SCOPUS_ID:0034867618",
                "eid": "2-s2.0-0034867618",
                "dc:title": "Evaluation of invariant models for dolphin photo-identification",
                "dc:creator": "Araabi B.",
                "prism:publicationName": "Proceedings of the IEEE Symposium on Computer-Based Medical Systems",
                "prism:issn": "10637125",
                "prism:pageRange": "203-209",
                "prism:coverDate": "2001-01-01",
                "prism:coverDisplayDate": "2001",
                "citedby-count": "1",
                "affiliation": [
                    {
                        "@_fa": "true",
                        "affilname": "Texas A&amp;M University",
                        "affiliation-city": "College Station",
                        "affiliation-country": "United States"
                    }
                ],
                "prism:aggregationType": "Conference Proceeding",
                "subtype": "cp",
                "subtypeDescription": "Conference Paper",
                "source-id": "23681",
                "openaccess": "0",
                "openaccessFlag": false
            },
            {
                ...
            }
        ]
    }
}
```

### 2. Serial Title
Endpoint           | **GET** https://api.elsevier.com/content/serial/title
------------------ | ------------------------------------------
Headers            | X-ELS-APIKey: Your API KEY
Query Parameters   | issn  ( like: 00313203 )

<br/>

**NOTE:** The information in the table above is the minimum requirements for each request.

*for more information about this api: [Scopus Serial Title API](https://dev.elsevier.com/documentation/SerialTitleAPI.wadl)*

Response:
```json
{
    "serial-metadata-response": {
        "link": [
            {
                "@_fa": "true",
                "@ref": "self",
                "@href": "https://api.elsevier.com/content/serial/title?start=0&count=25&issn=00313203&apiKey=6e54e7497e1caf8e7229958b8fd42b16&view=STANDARD",
                "@type": "application/json"
            },
            {
                ...
            }
        ],
        "entry": [
            {
                "@_fa": "true",
                "dc:title": "Pattern Recognition",
                "dc:publisher": "Elsevier Ltd.",
                "coverageStartYear": "1968",
                "coverageEndYear": "2021",
                "prism:aggregationType": "journal",
                "source-id": "24823",
                "prism:issn": "0031-3203",
                "openaccess": "0",
                "openaccessArticle": false,
                "openArchiveArticle": false,
                "openaccessType": "None",
                "openaccessStartDate": null,
                "oaAllowsAuthorPaid": true,
                "subject-area": [
                    {
                        "@_fa": "true",
                        "@code": "1712",
                        "@abbrev": "COMP",
                        "$": "Software"
                    },
                    {
                        ...
                    }
                ],
                "SNIPList": {
                    "SNIP": [
                        {
                            "@_fa": "true",
                            "@year": "2020",
                            "$": "3.419"
                        }
                    ]
                },
                "SJRList": {
                    "SJR": [
                        {
                            "@_fa": "true",
                            "@year": "2020",
                            "$": "1.492"
                        }
                    ]
                },
                "citeScoreYearInfoList": {
                    "citeScoreCurrentMetric": "15.7",
                    "citeScoreCurrentMetricYear": "2020",
                    "citeScoreTracker": "11.1",
                    "citeScoreTrackerYear": "2021"
                },
                "link": [
                    {
                        "@_fa": "true",
                        "@ref": "scopus-source",
                        "@href": "https://www.scopus.com/source/sourceInfo.url?sourceId=24823"
                    },
                    {
                        ...
                    }
                ],
                "prism:url": "https://api.elsevier.com/content/serial/title/issn/0031-3203"
            }
        ]
    }
}
```

## License
The Easy Publicate is open-sourced software licensed under the [MIT License](https://github.com/Mohammadreza-73/Easy-Publicate/blob/master/LICENSE).
