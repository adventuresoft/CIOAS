const fs = require('fs');
const path = require('path');

const dir = 'resources/views/frontend/pages';

function processFile(filePath) {
    let content = fs.readFileSync(filePath, 'utf8');
    let originalContent = content;

    // 1. Remove <div class="container..."> wrapper if it exists just after @section('content')
    // Find @section('content') followed by <div class="container...">
    const containerRegex = /(@section\('content'\)\s*)<div class="container[^"]*">\s*/;
    if (content.match(containerRegex)) {
        content = content.replace(containerRegex, '$1');
        // Remove the last </div> before @endsection
        content = content.replace(/<\/div>\s*(@endsection)/, '$1');
    }

    // 2. Replace bg-white ... with theme-form-card
    content = content.replace(/<div class="bg-white[^"]*">/g, '<div class="theme-form-card">');

    // 3. Replace header div classes
    // We look for <!-- Header --> and the immediately following <div class="...">
    const headerRegex = /<!--\s*Header\s*-->\s*<div class="[^"]*">/g;
    content = content.replace(headerRegex, '<!-- Header -->\n        <div class="theme-form-card-header">');

    // 4. Change h2, h3, h4, h5 inside the header to h2 and add theme-form-card-title
    // Now that header is theme-form-card-header, replace the h tag inside it.
    // It usually looks like:
    // <div class="theme-form-card-header">
    //     <div>
    //         <h4 class="fw-semibold fs-5">...</h4>
    const titleRegex = /(<div class="theme-form-card-header">\s*<div>\s*)<h[1-6][^>]*>(.*?)<\/h[1-6]>/g;
    content = content.replace(titleRegex, '$1<h2 class="theme-form-card-title">$2</h2>');
    
    // Sometimes there might be no <div> wrapping the <h4>, so let's handle that as well
    const titleRegex2 = /(<div class="theme-form-card-header">\s*)<h[1-6][^>]*>(.*?)<\/h[1-6]>/g;
    content = content.replace(titleRegex2, '$1<h2 class="theme-form-card-title">$2</h2>');

    if (content !== originalContent) {
        fs.writeFileSync(filePath, content, 'utf8');
        console.log('Updated: ' + filePath);
    }
}

function walkDir(currentDir) {
    const files = fs.readdirSync(currentDir);
    for (const file of files) {
        const fullPath = path.join(currentDir, file);
        if (fs.statSync(fullPath).isDirectory()) {
            walkDir(fullPath);
        } else if (fullPath.endsWith('.blade.php')) {
            processFile(fullPath);
        }
    }
}

walkDir(dir);
