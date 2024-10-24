using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(Restoran_MK.Startup))]
namespace Restoran_MK
{
    public partial class Startup {
        public void Configuration(IAppBuilder app) {
            ConfigureAuth(app);
        }
    }
}
