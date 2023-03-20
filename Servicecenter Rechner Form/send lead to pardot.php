<?php

public function sendLeadToPardot(): bool
{
  $pardotLeadModel = new HelperObjects\PardotLeadModel();
  $pardotLeadModel->company    = $this->rechnerData->UserInfo->Company;
  $pardotLeadModel->email      = $this->rechnerData->UserInfo->Email;
  $pardotLeadModel->salutation = $this->rechnerData->UserInfo->Salutation;
  $pardotLeadModel->FirstName  = $this->rechnerData->UserInfo->Firstname;
  $pardotLeadModel->LastName   = $this->rechnerData->UserInfo->Lastname;
  $pardotLeadModel->Phone      = $this->rechnerData->UserInfo->PhoneNumber;
  $pardotLeadModel->title      = $this->rechnerData->UserInfo->JobTitle;
  // what is this for?
  $pardotLeadModel->consent    = true;

  $url = "https://content.serviceocean.com/l/985421/2022-07-12/6bw2gk";

  // use http as key even though it's a https request
  $options = [
    "http" => [
      "header"  => "Content-type: application/x-www-form-urlencoded\r\n",
      "method"  => "POST",
      "content" => \http_build_query($pardotLeadModel)
    ]
  ];
  $context  = \stream_context_create($options);
  $result = \file_get_contents($url, false, $context);

  Logger::information("Sending data to Pardot");

  if ($result === false) {
    Logger::error("Sending data to Pardot failed");

    return false;
  } else {
    return true;
  }
}
