export function error401(err)
{
    if(err.response)
    {
      if(err.response.status == 401 || err.response.status == 419)
         {
            window.location.reload();
         }
    }
}