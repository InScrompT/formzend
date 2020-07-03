addEventListener('fetch', event => {
  event.respondWith(handleRequest(event.request))
});

const sendError = async (message) => {
  return new Response(JSON.stringify({
    error: true, message
  }), { 
    headers: {'content-type': 'application/json'}, 
    status: 401 
  });
}

/**
 * Respond with hello worker text
 * @param {Request} request
 */
async function handleRequest(request) {
  if (request.method !== 'POST') {  
    return sendError('expected a POST request');
  }
  
  if (request.headers.get('content-type') !== 'application/x-www-form-urlencoded') {
    return sendError('expected a form request');
  }

  let formData = [];
  const form = await request.formData();

  for (let field of form.entries()) {
    formData.push(field);
  }

  return new Response(JSON.stringify(formData), {
    headers: {'content-type': 'application/json'}
  });
}
