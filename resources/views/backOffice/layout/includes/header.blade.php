<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @include("backOffice.layout.includes.links.styleLinks")
    @include("backOffice.layout.includes.links.scriptLinks")

    @yield('style')
</head>
<body>
