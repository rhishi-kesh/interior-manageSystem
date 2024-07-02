<!DOCTYPE html>
<html>
<head>
    <title>Enrollment and Payment Confirmation</title>
</head>
<body>
    <div style="background-color: #ffffff">
        <table width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" style="padding: 0; margin: 0">
              <div style="margin: 0; padding: 20px 40px"></div>
              <table
                cellpadding="0"
                cellspacing="0"
                class="es-content"
                align="center"
              >
                <tr>
                  <td align="center" style="padding: 0; margin: 0">
                    <table
                      bgcolor="#efefef"
                      class="es-content-body"
                      align="center"
                      style="
                        border-collapse: collapse;
                        border-spacing: 0px;
                        background-color: #efefef;
                        border-radius: 20px 20px 0 0;
                        width: auto;
                      "
                    >
                      <tr>
                        <td
                          align="left"
                          style="
                            padding: 0;
                            margin: 0;
                            padding:20px;
                          "
                        >
                          <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                              <td
                                align="center"
                                valign="top"
                                style="padding: 0; margin: 0; width: 520px"
                              >
                                <table
                                  cellpadding="0"
                                  cellspacing="0"
                                  width="100%"
                                  bgcolor="#fafafa"
                                >
                                  <tr>
                                    <td
                                      align="left"
                                      style="padding: 10px; margin: 0"
                                    >
                                      <h3
                                        style="
                                          margin: 0;
                                          line-height: 34px;
                                          font-family: Imprima, Arial, sans-serif;
                                          font-size: 18px;
                                          font-style: normal;
                                          font-weight: bold;
                                          color: #2d3142;
                                          padding-button: 10px;
                                        " >  Dear
                                        {{ $details['name'] }}
                                      </h3>
                                      <br>
                                     <div>
                                        <div>
                                            <p  style="
                                            margin: 0;
                                            -webkit-text-size-adjust: none;
                                            -ms-text-size-adjust: none;
                                            font-family: Imprima, Arial, sans-serif;
                                            line-height: 27px;
                                            color: #2d3142;
                                            font-size: 18px;
                                          ">
                                              You have successfully enrolled in the {{ $details['departmentName'] }} course.
                                              <ul>
                                                <li style="
                                                margin: 0;
                                                -webkit-text-size-adjust: none;
                                                -ms-text-size-adjust: none;
                                                font-family: Imprima, Arial, sans-serif;
                                                line-height: 27px;
                                                color: #2d3142;
                                                font-size: 18px;
                                              ">Amount Paid: <b>{{ $details['paidAmount'] }}</b></li>
                                                <li style="
                                                margin: 0;
                                                -webkit-text-size-adjust: none;
                                                -ms-text-size-adjust: none;
                                                font-family: Imprima, Arial, sans-serif;
                                                line-height: 27px;
                                                color: #2d3142;
                                                font-size: 18px;
                                              ">Outstanding Balance: <b>{{ $details['dueAmount'] }}</b></li>
                                              </ul>
                                            </div>
                                            <br>
                                            <div >
                                                <p  style="
                                                margin: 0;
                                                -webkit-text-size-adjust: none;
                                                -ms-text-size-adjust: none;
                                                font-family: Imprima, Arial, sans-serif;
                                                line-height: 27px;
                                                color: #2d3142;
                                                font-size: 18px;
                                              ">
                                              Please ensure to settle the outstanding balance at your earliest convenience. If you have any questions or need further assistance, feel free to contact us.
                                              </p>
                                            </div>
                                            <br>
                                            <div style="display:block;color:black">
                                                <p style="
                                                margin: 0;
                                                -webkit-text-size-adjust: none;
                                                -ms-text-size-adjust: none;
                                                font-family: Imprima, Arial, sans-serif;
                                                line-height: 27px;
                                                color: #2d3142;
                                                font-size: 18px;
                                              ">Best regards,</p>
                                              <br> 
                                                <p style="
                                                margin: 0;
                                                -webkit-text-size-adjust: none;
                                                -ms-text-size-adjust: none;
                                                font-family: Imprima, Arial, sans-serif;
                                                line-height: 27px;
                                                color: #2d3142;
                                                font-size: 18px;
                                              ">Interior Bangladesh</p>
                                            </div>
                                     </div>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            
                            <tr>
                              <td><br /><br /></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              <table
              cellpadding="0"
              cellspacing="0"
              class="es-footer"
              align="center"
            >
              <tr>
                <td align="center" style="padding: 0; margin: 0">
                  <table
                    bgcolor="#bcb8b1"
                    class="es-footer-body"
                    align="center"
                    cellpadding="0"
                    cellspacing="0"
                    style="
                      border-collapse: collapse;
                      border-spacing: 0px;
                      background-color: #ffffff;
                      width: 600px;
                    "
                  >
                    <tr>
                      <td
                        align="left"
                        style="
                          margin: 0;
                          padding-left: 20px;
                          padding-right: 20px;
                          padding-bottom: 30px;
                          padding-top: 40px;
                        "
                      >
                        <table
                          cellpadding="0"
                          cellspacing="0"
                          width="100%"
                          style="border-collapse: collapse; border-spacing: 0px"
                        >
                          <tr>
                            <td
                              align="left"
                              style="padding: 0; margin: 0; width: 560px"
                            >
                              <table
                                cellpadding="0"
                                cellspacing="0"
                                width="100%"
                                style="
                                  border-collapse: collapse;
                                  border-spacing: 0px;
                                "
                              >
                              {{-- logo --}}
                                <tr>
                                  <td
                                    align="center"
                                    class="es-m-txt-c"
                                    style="
                                      padding: 0;
                                      margin: 0;
                                      font-size: 0px;
                                    "
                                  > 
                                  <a class="home-link" href="https://interiorbangladesh.com" title="Interior-Bangladesh" rel="home" aria-label="Logo" >
                                    <img loading="lazy" src="https://interiorbangladesh.com/frontend/images/logo.png" alt="logo" class="img-center img-fluid" style="
                                    display: block;
                                    border: 0;
                                    outline: none;
                                    text-decoration: none;
                                    -ms-interpolation-mode: bicubic;
                                    font-size: 12px;    
                                "
                                title="Logo"
                                height="120" width="140">
                                </a>
                                 </td>
                                </tr>
                                {{-- links --}}
                                <tr>
                                  <td
                                    align="center"
                                    class="es-m-txt-c"
                                    style="
                                      padding: 0;
                                      margin: 0;
                                      padding-bottom: 10px;
                                      font-size: 0;
                                    "
                                  >
                                    <table
                                      cellpadding="0"
                                      cellspacing="0"
                                      class="es-table-not-adapt es-social"
                                      style="
                                        border-collapse: collapse;
                                        border-spacing: 0px;
                                      "
                                    >
                                    <tr>
                                    <td
                                        align="center"
                                        valign="top"
                                        style="
                                        padding: 0;
                                        margin: 0;
                                        padding-right: 5px;
                                        "
                                    >
                                        <a
                                        target="_blank"
                                        href="https://www.facebook.com/bangladeshinterior"
                                        style="
                                            -webkit-text-size-adjust: none;
                                            -ms-text-size-adjust: none;
                                            text-decoration: underline;
                                            color: #2d3142;
                                            font-size: 14px;
                                        "
                                        >
                                        <img
                                            src="https://ebyhigd.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png"
                                            alt="Fb"
                                            title="Facebook"
                                            height="24"
                                            style="
                                            display: block;
                                            border: 0;
                                            outline: none;
                                            text-decoration: none;
                                            -ms-interpolation-mode: bicubic;
                                            "
                                        />
                                        </a>
                                    </td>
                                    <td
                                        align="center"
                                        valign="top"
                                        style="
                                        padding: 0;
                                        margin: 0;
                                        padding-right: 5px;
                                        "
                                    >
                                        <a
                                        target="_blank"
                                        href="https://www.instagram.com/interior.bangladesh/"
                                        style="
                                            -webkit-text-size-adjust: none;
                                            -ms-text-size-adjust: none;
                                            text-decoration: underline;
                                            color: #2d3142;
                                            font-size: 14px;
                                        "
                                        >
                                        <img
                                            src="https://freepngimg.com/save/58409-amstel-computer-instagram-gold-icons-race-logo/560x560"
                                            alt="Ins"
                                            title="Instragram"
                                            height="24"
                                            style="
                                            display: block;
                                            border: 0;
                                            outline: none;
                                            text-decoration: none;
                                            -ms-interpolation-mode: bicubic;
                                            "
                                        />
                                        </a>
                                    </td>
                                    <td
                                        align="center"
                                        valign="top"
                                        style="padding: 0; margin: 0"
                                    >
                                        <a
                                        target="_blank"
                                        href="https://www.linkedin.com/company/interior-bangladesh/"
                                        style="
                                            -webkit-text-size-adjust: none;
                                            -ms-text-size-adjust: none;
                                            text-decoration: underline;
                                            color: #2d3142;
                                            font-size: 14px;
                                        "
                                        >
                                        <img
                                            src="https://ebyhigd.stripocdn.email/content/assets/img/social-icons/logo-black/linkedin-logo-black.png"
                                            alt="In"
                                            title="Linkedin"
                                            height="24"
                                            style="
                                            display: block;
                                            border: 0;
                                            outline: none;
                                            text-decoration: none;
                                            -ms-interpolation-mode: bicubic;
                                            "
                                        />
                                        </a>
                                    </td>
                                    </tr>
                                    </table>
                                  </td>
                                </tr>
                                {{-- footer --}}
                                <tr>
                                  <td
                                    align="center"
                                    style="
                                      padding: 0;
                                      margin: 0;
                                      padding-top: 20px;
                                    "
                                  >
                                    <p
                                      style="
                                        margin: 0;
                                        -webkit-text-size-adjust: none;
                                        -ms-text-size-adjust: none;
                                        font-family: Imprima, Arial, sans-serif;
                                        line-height: 21px;
                                        color: #2d3142;
                                        font-size: 14px;
                                      "
                                    >
                                      Copyright © 2016-{{ date('Y') }}
                                      <a
                                        href="https://interiorbangladesh.com/"
                                        target="_blank"
                                        style="
                                          -webkit-text-size-adjust: none;
                                          -ms-text-size-adjust: none;
                                          text-decoration: underline;
                                          color: #2d3142;
                                          font-size: 14px;
                                        "
                                      >
                                      Interior Bangladesh
                                      </a>
                                      <br type="_moz" />
                                    </p>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            </td>
          </tr>
        </table>
      </div>
</body>
</html>
