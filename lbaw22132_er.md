# ER: Requirements Specification Component

> Project vision.

# A1: PROJECT PRESENTATION - ONLINE AUCTIONS

### Context & Motivation

* The purpose of this project is the development of an information system with web interface to support online auctions. With today's importance of internet in our lives, transferring physical auctions to online auctions marks a huge step into the online market, which makes this project challenging and interesting. Any resgistred user will be able to place items up for auction or to participate in auctions. For that, the system should manage bidding deadlines and determinate the winner and many more features;

* This platform is dedicated to everyone over the age of 17, family, friends, groups of people and whoever is interested in Online Auctions. 

### Goals & Objectives

* The main goals for this project are to create a platform able to automatically manage auctions with a smooth and clean interface, thinking about the user's needs and comfort. Also with the system managers, we want to ensure that the enviroment is safe and scam free, protecting our users.

### Features
* The application alows users to create a catalog of items for auction and to see the current bidding, as well as the corresponding bidder. In addiction, bidders can watch the auctioner catalog and decide which items to bid, according to the current bid.
* The interface will be designed to help users having a pleasant experience, adapted to all devices and focused on its safety.

* Once authenticated, users will have a profile with name, address, country and profile picture, as well as a review section where other users can comment their experience with past auctions. 

* Regarding our search features, users will be able to search by categories, filter certain content and search by keywords.

### Access Groups

* Users are seperated into groups with different permissions, feauturing system managers, bidders and auctioners:
    * Managers will be able to stop auctions, block users and delete content on the platform.
    * Bidders will be able to participate in auctions.
    * Auctioneers will be able to place items for auction.
    * There is also the possiblity of having guests, which are unauthenticated users who will be able to watch catalogs and currents bids but will not be able to participate in with biddings or auctions.

## A2: Actors and User stories

> Brief presentation of the artefact goals.


### 1. Actors

Users are represented in this diagram:

![Figure 1, the Actors](/assets/A2.png) 

Figure 1, the Actors

|Identifier|Description|
|:---:|:---:|
|User| Generic user who has access to public information|
|Auctioneer|  Can put an item for auction.|
|Bidder| Can bid on a auction.|
|Guest| Can be able to browse and to sign-up or sign-in.|
|Manager| Can be able to manage auctions and users.|


### 2. User Stories

This section includes each user stories by each type of actors.

#### 2.1. Guest
|Identifier|Name|Priority|Description|
|:---:|:---:|:---:|:---:|
|US01 | Sign-in | High | As a Guest, I want to authenticate into the system so that I can access priviliged information.|
|US02 | Sing-up | High | As a Guest, I want to register into the system so that I can authenticate myself into the system. 

#### 2.2. User

|Identifier|Name|Priority|Description|
|:---:|:---:|:---:|:---:|
| US11 | See Home | High | As a User, I want to access the home page, so that I can see a brief presentation of the website.
| US12 | See About | Medium | As a User, I want to access the about page, so that I can see a complete description of the website and its creators.
| US13 | Check FAQs | Medium | As a User, I want to access the FAQs, so that I can get quick answers to common questions.
| US14 | Consult Contacts | Medium | As a User, I want to access contacts, so that I can come in touch with the platform creators.
| US15 | Search | High | As a User, I want to be able to search for 

#### 2.3 Auctioneer

|Identifier|Name|Priority|Description|
|:---:|:---:|:---:|:---:|
|US21 | Auction | High |As a Auctioneer I want to be able to put up items for auction.
|US22 | Monitor | High |As a Auctioneer I want to be able to monitor the progress of the auction.
|US23 | Statistics | High |As a Auctioneer I want to be able to view and review the sales statistics and ratings.

#### 2.4 Bidder

|Identifier|Name|Priority|Description|
|:---:|:---:|:---:|:---:|
| US31 | Bidding | High | As a Bidder I want to bid in auctions.
| US32 | Cancel auction | High | As a Bidder I want to cancel auctions.
| US33 | Review | High | As a Bidder I want to leave review or feedback of auctioneers.
| US34 | View Statistics | High | As a Bidder I want to check the Statistics of the auctioneer.

### 2.5 Manager

|Identifier|Name|Priority|Description|
|:---:|:---:|:---:|:---:|
| US41 | Cancel Auction | High | As a Manager I want to cancel inapropriate auctions.
| US42 | Ban User | High | As a Manager I want to ban users who disrespect the rules.
| US43 | Moderate Auction | High | As a Manager I want to be able to moderate the auctions.


### 3. Supplementary Requirements

This section contains business rules, technical requirements and restrictions on the project.

#### 3.1. Business rules

|Identifier|Name|Description|
|:---:|:---:|:---:|
|BR01|Deleted Client|When a Client deletes his account, his actions will be also deleted|
|BR02|Completed auction|When the auction is marked as complete future bids are closed|
|BR03|Bidding|A item is only available for bidding if the user is logged|

#### 3.2. Technical requirements

|Identifier|Name|Description|
|:---:|:---:|:---:|
|TR01|Availability|The website must be available 99 percent of the time in each 24-hour period|
|TR02|Accessibility|The website must ensure that everyone can access the pages, regardless of the Web browser they use|
|TR03|Portability|The server-side system should work across multiple platforms (Linux, macOS, etc.)|
|TR04|Security|The system shall protect information from unauthorized access through the use of an authentication and verification system|
|TR05|Usability|The website should be simple and easy to use|
|TR06|Web Application|The website should be implemented as a Web application with dynamic pages (HTML, JavaScript, CSS and PHP)|
|TR07|Scalability|The system must be prepared to deal with the growth in the number of users and their actions|

#### 3.3. Restrictions

|Identifier|Name|Description|
|:---:|:---:|:---:|
|R01|Deadline|The system should be ready to use at the end of the semester|


## A3: Information Architecture

> Brief presentation of the artefact goals.


### 1. Sitemap

> Sitemap presenting the overall structure of the web application.  
> Each page must be identified in the sitemap.  
> Multiple instances of the same page (e.g. student profile in SIGARRA) are presented as page stacks.


### 2. Wireframes

> Wireframes for, at least, two main pages of the web application.
> Do not include trivial use cases.


#### UIxx: Page Name

#### UIxx: Page Name


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ...

***
GROUP22132, 26/09/2022

* Miguel Tavares, up202002811@up.pt (Editor)
* Gonçalo Ferreira, 202004761@up.pt
* Domingos Santos, 201906680@up.pt 
* João Félix , 202008867@up.pt