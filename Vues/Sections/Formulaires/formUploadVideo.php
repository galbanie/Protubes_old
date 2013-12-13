<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div id="uploadStartingBox">
    <!--div class="container">
            <h2>You can select the video and click Upload button</h2>
            <div class="upload_form_cont">
                <form id="upload_form" enctype="multipart/form-data" method="post" action="Outils/upload.php">
                    <div>
                        <div><label for="file">Please select video file</label></div>
                        <div><input type="file" name="file" id="file" onchange="fileSelected('video');" /></div>
                    </div>
                    <div class="btn-send">
                        <input type="button" value="Upload" onclick="startUploading()" />
                    </div>
                    <div id="fileinfo">
                        <div id="filename"></div>
                        <div id="filesize"></div>
                        <div id="filetype"></div>
                        <div id="filedim"></div>
                    </div>
                    <div id="error">You should select valid video files only!</div>
                    <div id="error2">An error occurred while uploading the file</div>
                    <div id="abort">The upload has been canceled by the user or the browser dropped the connection</div>
                    <div id="warnsize">Your file is very big. We can't accept it. Please select more small file</div>

                    <div id="progress_info">
                        <div id="progress"></div>
                        <div id="progress_percent">&nbsp;</div>
                        <div class="clear_both"></div>
                        <div>
                            <div id="speed">&nbsp;</div>
                            <div id="remaining">&nbsp;</div>
                            <div id="b_transfered">&nbsp;</div>
                            <div class="clear_both"></div>
                        </div>
                        <div id="upload_response"></div>
                    </div>
                </form>

                <!--img id="preview" />
            </div>
        </div-->
        <input type="file" id="fileElem" multiple="true" accept="image/*" onchange="handleFiles(this.files)"> 
	<span style="font-size:14px;color: #1F6289;font-weight:bold;">Browse and select OR Drop file below</span> 
	<div id="dropbox">Drag and Drop Files Here</div>
	<div class="upload-progress"></div>
</div>