<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Progress Service Request</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif; line-height: 1.6;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
        <tr>
            <td align="center" style="padding: 20px 0 30px 0;">
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    
                    <tr>
                        <td align="center" style="padding: 20px 30px 20px 30px; background-color: #00559C; color: #ffffff; border-bottom: 1px solid #e0e0e0;">
                            <h1 style="margin: 0; font-size: 24px; font-weight: bold;">
                                Software Request In Progress Submitted
                            </h1>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 30px 30px 20px 30px; color: #333333; font-size: 14px;">
                            <p style="margin: 0 0 20px 0; font-size: 16px;">
                                **System Notification:** software service request In Progress requires your attention.
                            </p>

                            <table border="0" cellpadding="10" cellspacing="0" width="100%" style="border-collapse: collapse; border: 1px solid #eeeeee;">
                                <tr>
                                    <td style="background-color: #f9f9f9; width: 30%;"><strong>In Progress Date:</strong></td>
                                    <td style="background-color: #f9f9f9;">{{ $requestData['in_progress_date'] }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><strong>Assignee:</strong></td>
                                    <td>{{ $requestData['assignee'] }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f9f9f9;"><strong>Priority:</strong></td>
                                    <td style="background-color: #f9f9f9;">{{ $requestData['priority'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Software Team Comment:</strong></td>
                                    <td>{{ $requestData['software_comment'] }}</td>
                                </tr>
                            </table>

                            <!-- <h3 style="font-size: 16px; margin: 30px 0 10px 0; border-bottom: 1px solid #e0e0e0; padding-bottom: 5px;">
                                Request Description
                            </h3>
                            <p style="margin: 0; padding: 10px; background-color: #f9f9f9; border-left: 3px solid #00559C;">
                                {{ $requestData['Request_Description'] }}
                            </p> -->

                            <p style="margin-top: 30px; font-size: 15px; font-weight: bold;">
                                Please review this request as soon as possible.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 20px 30px 20px 30px; background-color: #00559C; color: #ffffff; font-size: 12px; border-top: 1px solid #e0e0e0;">
                            &copy; {{ date('Y') }} RGL IT Service. All Rights Reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>