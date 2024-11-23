function start_download() {
    const progressBar = document.getElementById('progress-bar');


    const downloadUrl = 'files/Sploder.exe'; // Replace with your file download URL

    fetch(downloadUrl)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            const progressContainer = document.getElementById('progress-container');
            progressContainer.style.display = 'block';
            const contentLength = +response.headers.get('Content-Length');
            const reader = response.body.getReader();
            let receivedLength = 0;
            const chunks = [];

            return new ReadableStream({
                start(controller) {
                    function push() {
                        reader.read().then(({ done, value }) => {
                            if (done) {
                                controller.close();
                                const blob = new Blob(chunks); // Combine all chunks into a Blob
                                const url = URL.createObjectURL(blob);
                                setTimeout(() => {
                                    const progressContainer = document.getElementById('finished');
                                    progressContainer.style.display = 'flex';

                                    // Trigger the browser save dialog
                                    const a = document.createElement('a');
                                    a.href = url;
                                    a.download = 'Sploder-Update-Setup.exe'; // Set the desired file name
                                    document.body.appendChild(a);
                                    a.click();
                                    document.body.removeChild(a);

                                    // Revoke the object URL after the download
                                    URL.revokeObjectURL(url);
                                }, 1000); // Wait for 1 second (1000 milliseconds)
                            }
                            chunks.push(value);
                            receivedLength += value.length;

                            const percentComplete = (receivedLength / contentLength) * 100;
                            progressBar.style.width = `${percentComplete}%`;

                            controller.enqueue(value);
                            push();
                        }).catch(err => console.error(err));
                    }
                    push();
                }
            });
        })
        .catch(err => console.error('Error during fetch:', err));
};