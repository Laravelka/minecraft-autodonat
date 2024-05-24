function parseJsonToHtml(jsonData) {
    let htmlContent = '';
    function parseElement(element) {
        if (element.text) {
            htmlContent += `<span style="color: ${element.color || 'inherit'}; ${element.italic ? 'font-style: italic;' : ''} ${element.bold ? 'font-weight: bold;' : ''}">${element.text}</span>`;
        }

        if (element.extra) {
            element.extra.forEach(subElement => {
                parseElement(subElement);
            });
        }
    }

    if (jsonData.extra) {
        jsonData.extra.forEach(element => {
            parseElement(element);
        });
    }

    return htmlContent.length == 0 ? jsonData : htmlContent;
}

export {
    parseJsonToHtml
}
